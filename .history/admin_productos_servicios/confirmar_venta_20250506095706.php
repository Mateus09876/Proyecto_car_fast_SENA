<?php
include 'conexion.php'; // conexión a la base de datos

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE ventas SET estado='confirmada' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Venta confirmada exitosamente.";
    } else {
        echo "Error al confirmar venta.";
    }
}
?>
