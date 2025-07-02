<?php

class General
{
    public static function getTeacherAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tu.*,
            tc.name AS nombreCampus
        FROM 
            tbl_user tu
        JOIN
            tbl_campus tc ON tc.id = tu.campus_id
        WHERE 
            tu.rol_id = 1
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getTeacherActiveAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tu.*,
            tc.name AS nombreCampus
        FROM 
            tbl_user tu
        JOIN
            tbl_campus tc ON tc.id = tu.campus_id
        WHERE 
            tu.rol_id = 1 
        AND 
        tu.state = 'activo'
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getStudentsAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tu.*,
            tc.name AS nombreCampus
        FROM 
            tbl_user tu
        JOIN
            tbl_campus tc ON tc.id = tu.campus_id
        WHERE 
            tu.rol_id = 2
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getStudentsActiveAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tu.*,
            tc.name AS nombreCampus
        FROM 
            tbl_user tu
        JOIN
            tbl_campus tc ON tc.id = tu.campus_id
        WHERE 
            tu.rol_id = 2
        AND 
            tu.state = 'activo'
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getCampusAll()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_campus WHERE state = 'activo'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addUser($nombres, $codigo, $celular, $sexo, $estado_civil, $campus_id, $correo_institucional, $corre_personal, $pass, $rol)
    {
        global $conn;
        $sql = "INSERT INTO tbl_user (full_name, code, gender, civil_status, institutional_mail, personal_mail, campus_id, rol_id, phone, password, state) 
            VALUES (:nombres, :codigo, :sexo, :estado_civil, :correo_institucional, :corre_personal, :campus_id, :rol, :celular, :pass, 'activo')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':estado_civil', $estado_civil);
        $stmt->bindParam(':campus_id', $campus_id);
        $stmt->bindParam(':correo_institucional', $correo_institucional);
        $stmt->bindParam(':corre_personal', $corre_personal);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':rol', $rol);

        return $stmt;
    }
    public static function getUserId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_user WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function editUser($id, $nombres, $codigo, $celular, $sexo, $estado_civil, $campus_id, $correo_institucional, $corre_personal, $pass, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_user 
                SET full_name = :nombres, 
                    code = :codigo, 
                    gender = :sexo, 
                    civil_status = :estado_civil, 
                    institutional_mail = :correo_institucional, 
                    personal_mail = :corre_personal, 
                    campus_id = :campus_id, 
                    phone = :celular, 
                    password = :pass,
                    state = :estado
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':estado_civil', $estado_civil);
        $stmt->bindParam(':campus_id', $campus_id);
        $stmt->bindParam(':correo_institucional', $correo_institucional);
        $stmt->bindParam(':corre_personal', $corre_personal);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }
    public static function settingsAdminId($id, $nombre, $usuario, $pass)
    {
        global $conn;
        $sql = "UPDATE tbl_admin SET nombre=:nombre, usuario=:usuario, pass=:pass WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':pass', $pass);
        return $stmt;
    }
    public static function addCampus($nombre)
    {
        global $conn;
        $sql = "INSERT INTO tbl_campus (name) 
            VALUES (:nombre)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt;
    }
    public static function getCampusId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_campus WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function editCampusId($id, $nombre, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_campus SET name=:nombre, state=:estado WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }
    public static function addCourse($nombre)
    {
        global $conn;
        $sql = "INSERT INTO tbl_cursos (nombre, estado) 
            VALUES (:nombre, 'activo')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt;
    }
    public static function getCourseAll()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_cursos");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getTemasAll()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_temas");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getCourseById($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_cursos WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    public static function getClassesId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_temas WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public static function getThemeCourseId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT id, nombre FROM tbl_temas WHERE curso_id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public static function addTheme($curso_id, $tema)
    {
        global $conn;
        $statement = $conn->prepare("INSERT INTO tbl_temas (curso_id, nombre) VALUES (:curso_id, :nombre)");
        $statement->bindValue(":curso_id", $curso_id);
        $statement->bindValue(":nombre", $tema);
        return $statement->execute();
    }
    public static function getClassesAll()
    {
        global $conn;
        $statement = $conn->prepare("
        SELECT 
        tc.*,
        tu.full_name AS nombreDocente
        FROM 
            tbl_class tc
        JOIN
            tbl_user tu ON tu.id = tc.teacher_id

        ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getStudentsByClassId($class_id)
    {
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tcs.*,
            tu.full_name AS nombreEstudiante
        FROM 
            tbl_class_students  tcs
        JOIN
            tbl_user tu ON tu.id = tcs.students_d 
        WHERE 
        tcs.class_id=:class_id");
        $statement->bindValue(":class_id", $class_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public static function updateCourse($id, $nombre)
    {
        global $conn;
        $sql = "UPDATE tbl_cursos SET nombre = :nombre WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id);
        return $stmt;
    }

    public static function deleteThemesByCourseId($courseId)
    {
        global $conn;
        $sql = "DELETE FROM tbl_temas WHERE curso_id = :courseId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':courseId', $courseId);
        return $stmt->execute();
    }
    public static function deleteThemeById($temaId)
    {
        global $conn;
        $sql = "DELETE FROM tbl_temas WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $temaId);
        return $stmt->execute();
    }
    public static function getCountDocentes()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_user
        WHERE 
            rol_id = 1
    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountEstudiantes()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_user
        WHERE 
            rol_id = 1
    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountClases()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_class

    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountCursos()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_cursos

    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountTemas()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_temas

    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountSedes()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_campus

    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getClassesPorDia()
    {
        global $conn;
        $mes_actual = date('m');
        $anno_actual = date('Y');

        $statement = $conn->prepare("
            SELECT 
                DAY(start_date) as dia,
                MONTH(start_date) as mes,
                COUNT(*) as total_clases
            FROM 
                tbl_class
            WHERE 
                MONTH(start_date) = :mes
                AND YEAR(start_date) = :anno
            GROUP BY 
                DAY(start_date), MONTH(start_date)
        ");
        $statement->bindValue(":mes", $mes_actual);
        $statement->bindValue(":anno", $anno_actual);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
