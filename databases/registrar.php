<?php
// Validacion de metodo de procesamiento para los datos 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Acceso denegado si no se utiliza el método POST
    $response = array("success" => false, "message" => "Acceso denegado");
    echo json_encode($response);
    exit();
}
// recibir datos post
$nombre = $_POST['nombre'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$numero_tarjeta = $_POST['numero_tarjeta'];
$url_youtube = $_POST['url_youtube'];
// sanitizar caracteres
$nombre = htmlspecialchars($nombre);
$fecha_nacimiento = htmlspecialchars($fecha_nacimiento);
$numero_tarjeta = htmlspecialchars($numero_tarjeta);
$url_youtube = htmlspecialchars($url_youtube);
// se requiere conexión PDO
require_once("conex.php");
// Insertar datos utilizando sentencias preparadas
try {
    $query = $pdo->prepare("INSERT INTO cliente (nombre, fecha_nacimiento, numero_tarjeta, url_youtube) VALUES (:nom, :fecha, :tarjeta, :url)");
    $query->bindParam(":nom", $nombre);
    $query->bindParam(":fecha", $fecha_nacimiento);
    $query->bindParam(":tarjeta", $numero_tarjeta);
    $query->bindParam(":url", $url_youtube);
    // Verificar si se insertó correctamente
    if ($query->execute()) {
        $response = array("success" => true, "message" => "Registro exitoso");
        echo json_encode($response);
    } else {
        // error de ejecución de la consulta
        $response = array("success" => false, "message" => "Error en la ejecución de la consulta: " . $query->errorInfo()[2]);
        echo json_encode($response);
    }
    // Cerrar la conexión y la sentencia
    $pdo = null;
    $query = null;
} catch (PDOException $e) {
    // Envio de error
    $response = array("success" => false, "message" => "Error en la consulta: " . $e->getMessage());
    // Retornar respuesta como JSON
    echo json_encode($response);
}
