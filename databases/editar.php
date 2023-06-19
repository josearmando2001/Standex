<?php
// Validacion de metodo de procesamiento para los datos 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si no se utiliza POST envia mensaje de error
    $response = array("success" => false, "message" => "Acceso denegado");
    echo json_encode($response);
    exit();
}
// Si no existe el id del cliente
if (!isset($_POST['id_cliente'])) {
    $response = array("success" => false, "message" => "ID de cliente no proporcionado");
    echo json_encode($response);
    exit();
}

// Recibir datos POST
$id_cliente = $_POST['id_cliente'];
$nombre = $_POST['nombre'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$numero_tarjeta = $_POST['numero_tarjeta'];
$url_youtube = $_POST['url_youtube'];

// Sanitizar caracteres
$id_cliente = htmlspecialchars($id_cliente);
$nombre = htmlspecialchars($nombre);
$fecha_nacimiento = htmlspecialchars($fecha_nacimiento);
$numero_tarjeta = htmlspecialchars($numero_tarjeta);
$url_youtube = htmlspecialchars($url_youtube);

// se requiere conexión PDO
require_once("conex.php");

// Actualizar datos utilizando sentencias preparadas
try {
    $query = $pdo->prepare("UPDATE cliente SET nombre = :nom, fecha_nacimiento = :fecha, numero_tarjeta = :tarjeta, url_youtube = :url WHERE id = :id_cliente");
    $query->bindParam(":id_cliente", $id_cliente);
    $query->bindParam(":nom", $nombre);
    $query->bindParam(":fecha", $fecha_nacimiento);
    $query->bindParam(":tarjeta", $numero_tarjeta);
    $query->bindParam(":url", $url_youtube);
    // Verificar si se actualizó correctamente
    if ($query->execute()) {
        $response = array("success" => true, "message" => "Actualización exitosa");
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
