<?php

class User {
    public static function queryVerificationLogin($code, $password){
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_user WHERE code = :code AND password = :password");
        $statement->bindParam(":code", $code);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
}