from flask import Flask, render_template, request, flash, redirect, url_for, session, jsonify, abort
from config import config
from flask_mysqldb import MySQL
from models.ModelUser import ModuleUser
import speech_recognition as sr
from models.entities.User import User
import threading
# librerias para funcion de hacer resumen
from sumy.parsers.plaintext import PlaintextParser
from sumy.nlp.tokenizers import Tokenizer
from sumy.summarizers.lsa import LsaSummarizer
import nltk

app = Flask(__name__)

db = MySQL(app)
# Descargar recursos de NLTK necesarios
nltk.download('stopwords')
nltk.download('punkt')
def generate_summary(text, sentence_count=5):
    parser = PlaintextParser.from_string(text, Tokenizer("spanish"))
    summarizer = LsaSummarizer()
    summary = summarizer(parser.document, sentence_count)
    return " ".join([str(sentence) for sentence in summary])



@app.route('/')
def index():
    return render_template('auth/index.html')

@app.route('/login')
def login():
    return render_template('auth/login.html')

@app.route('/login-income', methods=['POST'])
def login_income():
    if request.method == 'POST':
        code = request.form['code']
        password = request.form['password']
        
        logged_user = ModuleUser.login(db, code, password)
        
        if logged_user is not None:
            if logged_user.state == 'activo':
                session['logged_user'] = {
                    'id': logged_user.id,
                    'full_name': logged_user.full_name,
                    'role_id': logged_user.role_id
                }
                if logged_user.role_id == 1:
                    return redirect(url_for('dashboard_teacher'))
                elif logged_user.role_id == 2:
                    return redirect(url_for('dashboard_student'))
            else:
                flash("No se puede ingresar porque el usuario está inactivo.", "error")
                return redirect(url_for('login'))
        else:
            flash("Código o contraseña incorrectos", "error")
            return redirect(url_for('login'))


@app.route('/dashboard-teacher')
def dashboard_teacher():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 1:  # Verifica que el usuario sea un profesor
            user_data.role_name = 'DOCENTE'

            # Obtener el número de cursos o clases asignados al profesor
            assigned_classes_count = ModuleUser.get_assigned_classes_count(db, user_id)

            # Obtener el número de estudiantes inscritos en las clases del profesor
            enrolled_students_count = ModuleUser.get_enrolled_students_count(db, user_id)
            
            return render_template('auth/dashboard-teacher.html', user=user_data, 
                                assigned_classes_count=assigned_classes_count, 
                                enrolled_students_count=enrolled_students_count)
    
    abort(403)  # Devuelve un error 403 Forbidden si el usuario no tiene permiso

@app.route('/dashboard-student')
def dashboard_student():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 2:  # Verifica que el usuario sea un estudiante
            user_data.role_name = 'ESTUDIANTE'
            return render_template('auth/dashboard-student.html', user=user_data)
    
    abort(403)  # Devuelve un error 403 Forbidden si el usuario no tiene permiso

@app.route('/teacher-classes')
def teacher_classes():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 1:  # Verifica que el usuario sea un profesor
            user_data.role_name = 'DOCENTE'
            teacher_id = user_data.id
            
            # Agrega una impresión para depuración
            print(f"Teacher ID: {teacher_id}")
            
            cursor = db.connection.cursor()
            cursor.execute("SELECT name_class, name_curso, start_date, end_date, status, text, teacher_id, id FROM tbl_class WHERE teacher_id = %s", (teacher_id,))
            clases = cursor.fetchall()
            cursor.close()
            
            # Imprime las clases recuperadas para depuración
            print(f"Clases recuperadas: {clases}")
            
            return render_template('auth/teacher-classes.html', user=user_data, clases=clases)
    
    abort(403)  # Devuelve un error 403 Forbidden si el usuario no tiene permiso


@app.route('/live-class-teacher', methods=['GET'])
def live_class_teacher():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 1:  # Verifica que el usuario sea un profesor
            user_data.role_name = 'DOCENTE'
            class_id = request.args.get('class_id')
            if class_id:
                cursor = db.connection.cursor()
                cursor.execute("SELECT name_class, name_curso, start_date, end_date, status, recorded_content, teacher_id FROM tbl_class WHERE id = %s", (class_id,))
                clase = cursor.fetchone()
                cursor.close()
                if clase:
                    return render_template('auth/live-class-teacher.html', clase=clase, user=user_data, class_id=class_id)  # Pasa class_id
                else:
                    flash("Clase no encontrada", "error")
            else:
                flash("ID de clase no proporcionado", "error")
        else:
            abort(403)  # Devuelve un error 403 Forbidden si el usuario no tiene permiso
    return redirect(url_for('teacher_classes'))    

# Variable global para controlar el estado de grabación
is_recording = False
stop_listening = None  # Variable global para detener la escucha en segundo plano

def process_audio(recognizer, audio, class_id):
    try:
        # Reconocer el audio usando el servicio de Google
        text = recognizer.recognize_google(audio, language="es-ES")
        with app.app_context():  # Crear un contexto de aplicación
            # Conectar a la base de datos y actualizar el campo de texto
            cursor = db.connection.cursor()
            cursor.execute("UPDATE tbl_class SET recorded_content = CONCAT(COALESCE(recorded_content, ''), %s, ' ') WHERE id = %s", (text, class_id))
            db.connection.commit()
            cursor.close()
    except sr.UnknownValueError:
        # Ignorar errores de reconocimiento
        pass
    except sr.RequestError as e:
        # Imprimir errores de servicio de reconocimiento de voz
        print(f"Error con el servicio de reconocimiento de voz: {e}")

def start_background_listening(class_id):
    recognizer = sr.Recognizer()
    mic = sr.Microphone()

    def callback(recognizer, audio):
        process_audio(recognizer, audio, class_id)

    global stop_listening
    with mic as source:
        recognizer.adjust_for_ambient_noise(source)
    stop_listening = recognizer.listen_in_background(mic, callback)

@app.route('/start', methods=['POST'])
def start_recording():
    class_id = request.form.get('class_id')
    global is_recording

    if not is_recording:
        is_recording = True
        # Iniciar la escucha en segundo plano
        start_background_listening(class_id)
        return jsonify({'status': 'started'})
    else:
        return jsonify({'status': 'already recording'})

@app.route('/stop', methods=['POST'])
def stop_recording():
    global is_recording
    global stop_listening
    is_recording = False
    if stop_listening:
        stop_listening(wait_for_stop=False)
    return jsonify({'status': 'stopped'})

@app.route('/student-classes')
def student_classes():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 2:  # Verifica que el usuario sea un estudiante
            user_data.role_name = 'ESTUDIANTE'
            cursor = db.connection.cursor()
            cursor.execute("SELECT c.id, c.name_class, c.name_curso, c.start_date, c.end_date, c.status, c.text FROM tbl_class c INNER JOIN tbl_class_students cs ON c.id = cs.class_id WHERE cs.students_d = %s", (user_id,))
            clases = cursor.fetchall()
            cursor.close()
            return render_template('auth/student-classes.html', user=user_data, clases=clases)
        else:
            abort(403)  # Devuelve un error 403 Forbidden si el usuario no tiene permiso
    return redirect(url_for('login'))

@app.route('/live-class-student', methods=['GET'])
def live_class_student():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 2:  # Verifica que el usuario sea un estudiante
            user_data.role_name = 'ESTUDIANTE'
            class_id = request.args.get('class_id')
            if class_id:
                cursor = db.connection.cursor()
                cursor.execute("SELECT name_class, name_curso, start_date, end_date, status, recorded_content, teacher_id FROM tbl_class WHERE id = %s", (class_id,))
                clase = cursor.fetchone()
                cursor.close()
                if clase:
                    return render_template('auth/live-class-student.html', clase=clase, user=user_data)  # Pasa la variable user
                else:
                    flash("Clase no encontrada", "error")
            else:
                flash("ID de clase no proporcionado", "error")
        else:
            abort(403)  # Devuelve un error 403 Forbidden si el usuario no tiene permiso
    return redirect(url_for('student_classes'))

@app.route('/get-recorded-content', methods=['GET'])
def fetch_recorded_content():
    class_id = request.args.get('class_id')
    if class_id:
        cursor = db.connection.cursor()
        cursor.execute("SELECT recorded_content FROM tbl_class WHERE id = %s", (class_id,))
        content = cursor.fetchone()
        cursor.close()
        if content:
            return jsonify({'status': 'success', 'recorded_content': content[0]})
        else:
            return jsonify({'status': 'error', 'message': 'Contenido no encontrado'})
    else:
        return jsonify({'status': 'error', 'message': 'ID de clase no proporcionado'})


#resumen aquiconsultare mi conlumna de grabacion y guadare en resumen
@app.route('/generate-summary', methods=['POST'])
def generate_summary_endpoint():
    class_id = request.form.get('class_id')
    if class_id:
        cursor = db.connection.cursor()
        cursor.execute("SELECT recorded_content FROM tbl_class WHERE id = %s", (class_id,))
        result = cursor.fetchone()
        if result:
            recorded_content = result[0]
            resumen = generate_summary(recorded_content)
            cursor.execute("UPDATE tbl_class SET resumen = %s WHERE id = %s", (resumen, class_id))
            db.connection.commit()
            cursor.close()
            return jsonify({"status": "success", "resumen": resumen})
        else:
            cursor.close()
            return jsonify({"status": "error", "message": "Clase no encontrada"})
    return jsonify({"status": "error", "message": "ID de clase no proporcionado"})

#Perfil de usuarios
@app.route('/profile-student')
def profile_student():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 2:  # Verifica que el usuario sea un estudiante
            user_data.role_name = 'ESTUDIANTE'
            return render_template('auth/profile-student.html', user=user_data)
    
    abort(403) 

@app.route('/update-profile-student', methods=['POST'])
def update_profile_student():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        full_name = request.form.get('full_name')
        gender = request.form.get('gender')
        civil_status = request.form.get('civil_status')
        personal_mail = request.form.get('personal_mail')
        phone = request.form.get('phone')

        # Validar los datos antes de actualizarlos
        if not full_name or not gender or not personal_mail or not phone:
            flash("Todos los campos son obligatorios", "error")
            return redirect(url_for('profile_student'))

        success = ModuleUser.update_user_data(db, user_id, full_name, gender, civil_status, personal_mail, phone)
        if success:
            flash("Perfil actualizado exitosamente", "success")
        else:
            flash("Error al actualizar el perfil", "error")
        
        return redirect(url_for('profile_student'))
    
    abort(403)

@app.route('/profile-teacher')
def profile_teacher():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        user_data = ModuleUser.get_user_data(db, user_id)
        if user_data and user_data.role_id == 1:  # Verifica que el usuario sea un doncente
            user_data.role_name = 'DOCENTE'
            return render_template('auth/profile-teacher.html', user=user_data)
    
    abort(403) 


@app.route('/update-profile-teacher', methods=['POST'])
def update_profile_teacher():
    if 'logged_user' in session:
        user_id = session['logged_user']['id']
        full_name = request.form.get('full_name')
        gender = request.form.get('gender')
        civil_status = request.form.get('civil_status')
        personal_mail = request.form.get('personal_mail')
        phone = request.form.get('phone')

        # Validar los datos antes de actualizarlos
        if not full_name or not gender or not personal_mail or not phone:
            flash("Todos los campos son obligatorios", "error")
            return redirect(url_for('profile_teacher'))

        success = ModuleUser.update_user_data(db, user_id, full_name, gender, civil_status, personal_mail, phone)
        if success:
            flash("Perfil actualizado exitosamente", "success")
        else:
            flash("Error al actualizar el perfil", "error")
        
        return redirect(url_for('profile_teacher'))
    
    abort(403)




@app.route('/logout')
def logout():
    session.pop('logged_user', None)
    return redirect(url_for('login'))

if __name__ == '__main__':
    app.config.from_object(config['development'])
    app.run()
