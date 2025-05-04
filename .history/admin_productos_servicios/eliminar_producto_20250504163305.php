<?php
// Verificar si se pasa un ID de producto
if (isset($_GET['id'])) {
  $id_producto = $_GET['id'];

  // Conectar a la base de datos
  $pdo = new PDO("mysql:host=localhost;dbname=car_fast", "root", "");

  // Preparar la consulta para eliminar el producto
  $stmt = $pdo->prepare("DELETE FROM productos WHERE id_producto = ?");
  $stmt->execute([$id_producto]);

  // Redirigir a la página de productos después de eliminar
  header("Location: productos.html");
  exit;
} else {
  // Si no se pasa un ID, redirigir a la página de productos
  header("Location: productos.html");
  exit;
}
?>
