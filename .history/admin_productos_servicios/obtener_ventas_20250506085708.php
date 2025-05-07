<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión MySQL (puerto 3307)
$conexion = new mysqli("localhost", "root", "", "car_fast", 3307);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$consulta = "SELECT * FROM ventas";
$resultado = $conexion->query($consulta);

$ventas = [];

while ($fila = $resultado->fetch_assoc()) {
    $ventas[] = $fila;
}

echo json_encode($ventas);

$conexion->close();
?>
