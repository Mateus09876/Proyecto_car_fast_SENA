<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php"); // Redirige si no ha iniciado sesión
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
</head>
<body>
    <h2>Bienvenido, Administrador</h2>

    <a href="agregar_producto.php">➕ Agregar Producto o Servicio</a><br><br>
    <a href="editar_productos.php">✏️ Editar o Eliminar Productos</a><br><br>
    <a href="cerrar_sesion.php">🔒 Cerrar Sesión</a>
</body>
</html>
