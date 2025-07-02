<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
  
    // Editar el resto de los campos
    $result = General::addCampus($nombre);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'La sede se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar sede.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
