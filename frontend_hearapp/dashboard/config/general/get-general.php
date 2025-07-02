<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();

if (isset($_POST['action']) && $_POST['action'] == 'get_all_teacher') {
    $result = General::getTeacherAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_students') {
    $result = General::getStudentsAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_campus') {
    $result = General::getCampusAll();
    echo json_encode($result);
}
if (isset($_POST['action']) && $_POST['action'] == 'get_all_teacher_id') {
    $id = $_POST['resultId'];
    $result = General::getUserId($id);
    echo json_encode($result);
}

if (isset($_POST['action']) && $_POST['action'] == 'get_all_campus_id') {
    $id = $_POST['resultId'];
    $result = General::getCampusId($id);
    echo json_encode($result);
}
