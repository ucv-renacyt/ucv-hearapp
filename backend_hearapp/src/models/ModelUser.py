# Importar la clase User desde el módulo entities.User
from .entities.User import User

class ModuleUser():
    @staticmethod
    def login(db, code, password):
        cursor = db.connection.cursor()
        sql = "SELECT * FROM tbl_user WHERE code = %s AND password = %s"
        cursor.execute(sql, (code, password))
        row = cursor.fetchone()
        
        if row:
            # Pasar todos los valores de la fila a la clase User
            logged_user = User(*row)
            return logged_user
        else:
            return None

    @staticmethod
    def get_user_data(db, user_id):
        cursor = db.connection.cursor()
        sql = "SELECT id, full_name, code, gender, civil_status, institutional_mail, personal_mail, campus_id, rol_id, phone, password, state FROM tbl_user WHERE id = %s"
        cursor.execute(sql, (user_id,))
        row = cursor.fetchone()

        if row:
            user_data = User(*row)
            return user_data
        else:
            return None

    @staticmethod
    def update_user_data(db, user_id, full_name, gender, civil_status, personal_mail, phone):
        try:
            cursor = db.connection.cursor()
            cursor.execute("""
                UPDATE tbl_user 
                SET full_name = %s, gender = %s, civil_status = %s, personal_mail = %s, phone = %s
                WHERE id = %s
            """, (full_name, gender, civil_status, personal_mail, phone, user_id))
            db.connection.commit()
            cursor.close()
            return True
        except Exception as e:
            print(f"Error updating user data: {e}")
            return False

#metodo para mostrar en dsbr cantida de clases aginnadas al docente 
    @staticmethod
    def get_assigned_classes_count(db, teacher_id):
        cursor = db.connection.cursor()
        sql = "SELECT COUNT(*) FROM tbl_class WHERE teacher_id = %s"
        cursor.execute(sql, (teacher_id,))
        count = cursor.fetchone()[0]
        return count
    
# mostrar cantidad de estudiantes inscritos  
    @staticmethod
    def get_enrolled_students_count(db, teacher_id):
        cursor = db.connection.cursor()
        sql = """
        SELECT COUNT(DISTINCT tbl_class_students.students_d) 
        FROM tbl_class_students 
        INNER JOIN tbl_class ON tbl_class_students.class_id = tbl_class.id 
        WHERE tbl_class.teacher_id = %s
        """
        cursor.execute(sql, (teacher_id,))
        count = cursor.fetchone()[0]
        return count