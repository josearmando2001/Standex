<?php
// Validacion de metodo de procesamiento para los datos 
 if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    // Acceso denegado si no se utiliza el método POST
    $response = array("success" => false, "message" => "Acceso denegado");
    echo json_encode($response);
    exit();
}
require("conex.php");
// Sentencia SQL para listar todos los registros 
$consulta = $pdo->prepare("SELECT * FROM cliente ORDER BY id DESC");
// Se ejecuta la sentencia 
$consulta->execute();
// Resultado consulta todos los registro de la base de datos en PDO en un arreglo asociativo 
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
// Crea un arreglo
$datos = array();
// Realiza un foreach al resultado (datos consultados)
foreach ($resultado as $data) {
    // Los datos son igual a la variable data 
    $datos[] = $data;
 
}
// Codificar los datos en formato JSON
$json = json_encode($datos);
// Imprimir el resultado
echo $json;
?>