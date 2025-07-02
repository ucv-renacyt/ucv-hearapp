<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id =  !empty($_POST['id']) ? $_POST['id'] : null;
    $nombres =  !empty($_POST['nombres']) ? $_POST['nombres'] : null;
    $codigo =  !empty($_POST['codigo']) ? $_POST['codigo'] : null;
    $celular =  !empty($_POST['celular']) ? $_POST['celular'] : null;
    $sexo =  !empty($_POST['sexo']) ? $_POST['sexo'] : null;
    $estado_civil =  !empty($_POST['estado_civil']) ? $_POST['estado_civil'] : null;
    $campus_id =  !empty($_POST['campus_id']) ? $_POST['campus_id'] : null;
    $correo_institucional =  !empty($_POST['correo_institucional']) ? $_POST['correo_institucional'] : null;
    $corre_personal =  !empty($_POST['corre_personal']) ? $_POST['corre_personal'] : null;
    $pass =  !empty($_POST['pass']) ? $_POST['pass'] : null;
    $estado =  !empty($_POST['estado']) ? $_POST['estado'] : null;
    

    // Editar el resto de los campos
    $result = General::editUser($id,$nombres, $codigo, $celular, $sexo, $estado_civil, $campus_id, $correo_institucional, $corre_personal, $pass, $estado);


    if ($result->execute()) {

        // Items registrado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El Docente se edito correctamente.'
        );
    } else {
        // Error al registrar Items
        $response = array(
            'status' => 'error',
            'message' => 'Error al editar Docente.'
        );
    }
    // Devolver la respuesta como JSON
    echo json_encode($response);
}
