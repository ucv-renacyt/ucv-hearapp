# HearApp

HearApp es una plataforma educativa que integra reconocimiento de voz y gestión de clases, permitiendo a docentes y estudiantes interactuar en tiempo real, grabar y resumir contenido de clases, y administrar usuarios y cursos. El sistema cuenta con un backend en Python (Flask) y un frontend en PHP, además de scripts y archivos auxiliares para la gestión de la base de datos y la configuración.

## Características principales

- **Grabación y transcripción de clases en tiempo real** usando reconocimiento de voz.
- **Resúmenes automáticos** de las clases grabadas.
- **Gestión de usuarios** (docentes, estudiantes, administradores).
- **Paneles diferenciados** para cada tipo de usuario.
- **Gestión de cursos, clases y temas**.
- **Estadísticas y reportes** para administradores.

## Estructura del proyecto

```
HearApp/
├── backend_hearapp/        # Backend en Flask y scripts de base de datos
│   ├── src/
│   ├── env/
│   ├── levantar proyecto.txt
│   ├── requirements.txt
│   └── db_hearapp.sql
├── frontend_hearapp/       # Frontend en PHP
│   ├── dashboard/
│   ├── index.php
│   └── .htaccess
├── *.php                   # Scripts PHP auxiliares
├── *.html                  # Plantillas HTML
├── *.py                    # Scripts Python principales
├── *.sql                   # Scripts de base de datos
└── README.md               # Este archivo
```

## Tecnologías utilizadas

- **Backend:** Python, Flask, Flask-Login, Flask-MySQLdb, Flask-WTF, SQLAlchemy, SpeechRecognition, Sumy, NLTK
- **Frontend:** PHP, HTML, CSS, JavaScript, Chart.js
- **Base de datos:** MySQL

## Instalación y ejecución

### Backend (Flask)

1. Ve al directorio `backend_hearapp`:
   ```bash
   cd backend_hearapp
   ```
2. (Opcional) Crea y activa un entorno virtual:
   ```bash
   python -m venv env
   source env/bin/activate  # En Linux/Mac
   .\env\Scripts\activate  # En Windows
   ```
3. Instala las dependencias:
   ```bash
   pip install -r requirements.txt
   ```
4. Configura la base de datos MySQL usando el script `db_hearapp.sql`.
5. Ejecuta la aplicación:
   ```bash
   python src/app.py
   ```

### Frontend (PHP)

1. Ve al directorio `frontend_hearapp` y configura tu servidor web (Apache, Nginx, XAMPP, etc.) para servir los archivos PHP.
2. Asegúrate de que el backend esté corriendo y que la configuración de conexión a la base de datos sea correcta.

### Acceso rápido

- **Docente:**
  - Usuario: 7002483033 (Ana Lopez)
  - Contraseña: password1
- **Estudiante:**
  - Usuario: 7002483034 (Carlos Ramos)
  - Contraseña: password2
- **Usuario inactivo:**
  - Usuario: 7002483036 (Eduardo Perez)
  - Contraseña: password4

---
