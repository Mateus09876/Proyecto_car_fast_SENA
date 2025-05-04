<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración - Car Fast</title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
  <h1>Bienvenido, <?php echo $_SESSION['admin']; ?> 👋</h1>
  <h2>Gestión de Productos y Servicios</h2>

  <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="categoria" placeholder="Categoría" required>
    <input type="text" name="nombre" placeholder="Nombre del producto" required>
    <textarea name="descripcion" placeholder="Descripción (opcional)"></textarea>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="file" name="imagen" accept="image/*" required>
    <button type="submit">Agregar Producto</button>
  </form>

  <br><a href="logout.php">Cerrar sesión</a>
</body>
</html>
