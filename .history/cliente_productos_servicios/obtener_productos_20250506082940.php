<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "car_fast", 3307);

// Verifica conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta productos
$sql = "SELECT id_producto, nombre,direccion descripcion, precio, categoria, imagen FROM productos";
$resultado = $conexion->query($sql);

// Arreglo para guardar resultados
$productos = [];

while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
}

// Devuelve como JSON
header('Content-Type: application/json');
echo json_encode($productos);

// Cierra conexión
$conexion->close();
?>
