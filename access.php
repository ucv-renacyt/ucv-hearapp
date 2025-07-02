<?php
include '../conexion.php';
include '../../class/admin.php';



session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username =  !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    $userObj = Admin::consultSecuryty($username, $password);

    if ($userObj) {
        // Usuario encontrado, iniciar sesión
        $_SESSION['admin']  = $userObj; 
        $_SESSION['admin_id'] = $userObj->id; 

        $response = array(
            'status' => 'success',
            'message' => 'Usuario autenticado exitosamente.'
        );
    } else {
        // Usuario no encontrado o contraseña incorrecta
        $response = array(
            'status' => 'error',
            'message' => 'Nombre de usuario o contraseña incorrecta.'
        );
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
}
