<?php
include '../conexion.php';
include '../../class/general.php';
include '../../core/Security.php';


session_start();
$id = Security::getAdminId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_curso = !empty($_POST['curso_id']) ? $_POST['curso_id'] : null;
    $name_class = !empty($_POST['theme_id']) ? $_POST['theme_id'] : null;

    $cursoObj = General::getCourseById($name_curso);
    $nombreCurso = $cursoObj->nombre;

    $claseObj = General::getClassesId($name_class);
    $nombreClase = $claseObj->nombre;

    $teacher_id = !empty($_POST['teacher_id']) ? $_POST['teacher_id'] : null;
    $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : null;
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
    $status = 'activo';
    $students = !empty($_POST['students_id']) ? $_POST['students_id'] : array();

    try {
        // Iniciar una transacción
        $conn->beginTransaction();

        // Insertar la clase en la tabla tbl_class
        $stmt = $conn->prepare("INSERT INTO tbl_class (name_class, name_curso, teacher_id, start_date, end_date, status, created_at, text) VALUES (?, ?, ?, ?, ?, ?, NOW(), NULL)");
        $stmt->execute([$nombreClase, $nombreCurso, $teacher_id, $start_date, $end_date, $status]);
        $class_id = $conn->lastInsertId();
        $stmt->closeCursor();

        // Insertar las relaciones de estudiantes con la clase en la tabla tbl_class_students
        $stmt = $conn->prepare("INSERT INTO tbl_class_students (students_d, class_id) VALUES (?, ?)");
        foreach ($students as $student_id) {
            $stmt->execute([$student_id, $class_id]);
        }
        $stmt->closeCursor();

        // Confirmar la transacción
        $conn->commit();

        // Clase y estudiantes registrados correctamente
        $response = array(
            'status' => 'success',
            'message' => 'La clase se agregó correctamente.'
        );
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        $conn->rollBack();

        // Error al registrar la clase y/o estudiantes
        $response = array(
            'status' => 'error',
            'message' => 'Error al agregar la clase: ' . $e->getMessage()
        );
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
}
