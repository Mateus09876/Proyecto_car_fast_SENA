<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión MySQL (puerto 3307)
$conexion = new mysqli("localhost", "root", "", "car_fast", 3307);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta con LEFT JOIN a productos y servicios según el tipo
$consulta = "
    SELECT 
        v.id_venta,
        v.nombre_cliente,
        v.telefono,
        v.direccion,
        v.item,
        v.precio,
        v.fecha,
        v.tipo,
        v.estado,
        COALESCE(p.descripcion, s.descripcion) AS descripcion
    FROM ventas v
    LEFT JOIN productos p ON v.tipo = 'producto' AND v.item = p.nombre
    LEFT JOIN servicios s ON v.tipo = 'servicio' AND v.item = s.nombre
";

$resultado = $conexion->query($consulta);

$ventas = [];

while ($fila = $resultado->fetch_assoc()) {
    $ventas[] = $fila;
}

echo json_encode($ventas);

$conexion->close();
?>

