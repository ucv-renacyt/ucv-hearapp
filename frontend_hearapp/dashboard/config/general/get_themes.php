
<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();

if (isset($_GET['curso_id'])) {
    $curso_id = $_GET['curso_id'];

    $themes = General::getThemeCourseId($curso_id);
    
    header('Content-Type: application/json');
    echo json_encode($themes);
}
?>