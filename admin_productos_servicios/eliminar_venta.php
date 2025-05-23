<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli("localhost", "root", "", "car_fast", 3307);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_POST['id'] ?? null;

if ($id) {
    $stmt = $conexion->prepare("DELETE FROM ventas WHERE id_venta = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Venta eliminada correctamente.";
    } else {
        echo "Error al eliminar venta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de venta no recibido.";
}

$conexion->close();
?>

