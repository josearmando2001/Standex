<?php
// Recibir el contexto
$data = file_get_contents("php://input");
// Requiere la conexión 
require_once("conex.php");
// Creación de sentencia SQL para eliminar cuando el id sea igual al enviado
$query = $pdo->prepare("DELETE FROM cliente WHERE id = :id");
// se asigna el id a la variable data 
$query->bindParam(":id", $data);
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
