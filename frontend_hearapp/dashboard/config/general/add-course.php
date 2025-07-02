<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nombre =  !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $temas =  !empty($_POST['temas']) ? $_POST['temas'] : null;

    // Editar el resto de los campos
    $result = General::addCourse($nombre);


    if ($result->execute()) {

        $lastInsertedId = $conn->lastInsertId();


        // Insertar los temas asociados al curso
        foreach ($temas as $tema) {
            General::addTheme($lastInsertedId, $tema);
        }

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El curso se agregó correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar curso.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
