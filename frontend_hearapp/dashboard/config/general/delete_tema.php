<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';

session_start();
$id = Security::getAdminId();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['id'])) {
    $temaId = $_GET['id'];

    $result = General::deleteThemeById($temaId);

    if ($result) {
        // Tema eliminado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El tema se eliminó correctamente.'
        );
    } else {
        // Error al eliminar el tema
        $response = array(
            'status' => 'error',
            'message' => 'Error al eliminar el tema.'
        );
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
}
?>
