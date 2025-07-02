<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $usuario =  !empty($_POST['usuario']) ? $_POST['usuario'] : null;
    $pass =  !empty($_POST['pass']) ? $_POST['pass'] : null;




    // Editar el resto de los campos
    $result = General::settingsAdminId($id, $nombre, $usuario, $pass);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El Admin se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar Admin.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
