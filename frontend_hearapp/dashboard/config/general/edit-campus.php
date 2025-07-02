<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;


    // Editar el resto de los campos
    $result = General::editCampusId($id, $nombre, $estado);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'La sede se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar sede.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
