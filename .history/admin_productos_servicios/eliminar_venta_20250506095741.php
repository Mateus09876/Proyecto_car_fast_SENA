<?php
include 'conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM ventas WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Venta eliminada correctamente.";
    } else {
        echo "Error al eliminar la venta.";
    }
}
?>
