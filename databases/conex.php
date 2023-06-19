<?php
// Conexión a la base de datos por medio de PDO 
    $servidor = "mysql:dbname=standex;host=localhost";
    $user = "root";
    $pass = "";
    // Validación de conexión correcta 
    try {
        $pdo = new PDO($servidor, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOException $e) {
        // en caso de error 
        echo "conexion fallida" .$e->getMessage();
    }

?>

