<?php
$conexion = new mysqli("localhost", "root", "", "car_fast");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM ventas ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

$ventas = [];

while ($fila = $resultado->fetch_assoc()) {
    $ventas[] = $fila;
}

header('Content-Type: application/json');
echo json_encode($ventas);
?>

