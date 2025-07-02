<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';

session_start();
$id = Security::getAdminId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = !empty($_POST['course_id']) ? $_POST['course_id'] : null;
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $temas = !empty($_POST['temas']) ? $_POST['temas'] : null;

    // Actualizar el curso
    $result = General::updateCourse($courseId, $nombre);

    if ($result->execute()) {
        // Eliminar temas existentes del curso
        General::deleteThemesByCourseId($courseId);

        // Insertar los temas actualizados
        foreach ($temas as $tema) {
            General::addTheme($courseId, $tema);
        }

        // Curso actualizado correctamente
        $response = array(
            'status' => 'success',
            'message' => 'El curso se actualizó correctamente.'
        );
    } else {
        // Error al actualizar el curso
        $response = array(
            'status' => 'error',
            'message' => 'Error al actualizar el curso.'
        );
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
    exit();
} else {
    // Método de solicitud no permitido
    $response = array(
        'status' => 'error',
        'message' => 'Método no permitido.'
    );
    echo json_encode($response);
    exit();
}
