# Llave Privada - manejar envio de mensajes
class Config:
    SECRET_KEY = 'B!1weNAt1T^%kvhUI*S^'
# Configuracion de Desarrollo
class DevelopmentConfig(Config):
    # Modo depuracion, que ve los errores que pueda haber 
    DEBUG = True
    # Parametros para la conexion a la base de datos
    MYSQL_HOST = 'localhost'
    MYSQL_PORT = 3306  # Asegúrate de agregar el puerto aquí
    MYSQL_USER = 'root'
    MYSQL_PASSWORD = ''
    MYSQL_DB = 'db_hearappok'

# Diccionario que mapea nombres de configuraciones ('development') a las clases de configuración correspondientes (DevelopmentConfig)
config = { 
    'development': DevelopmentConfig
}
