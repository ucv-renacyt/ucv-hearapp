<?php
include '../conexion.php';
include '../../class/user.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $code =  !empty($_POST['code']) ? $_POST['code'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    $userObj = User::queryVerificationLogin($code, $password);

    if ($userObj) {
        // Usuario encontrado, iniciar sesión
        $_SESSION['user']  = $userObj; 
        $_SESSION['user_id'] = $userObj->id; 
        $_SESSION['user_role'] = $userObj->rol_id; // Guardar el rol del usuario en la sesión

        // Redireccionar según el rol del usuario
        if ($userObj->rol_id == 1) {
            header("Location: ../../templates/dashboard-student");
            exit();
        } else if ($userObj->rol_id == 2) {
            header("Location: ../../templates/dashboard-teacher");
            exit();
        } else {
            // Redireccionar a una página de error si el rol no está definido
            header("Location: ../../templates/404");
            exit();
        }

    } else {
        // Usuario no encontrado o contraseña incorrecta
        $response = array(
            'status' => 'error',
            'message' => 'Código de usuario o contraseña incorrecta.'
        );
        echo json_encode($response);
    }
}
?>
