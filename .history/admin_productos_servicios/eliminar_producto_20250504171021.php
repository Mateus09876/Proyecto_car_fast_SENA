<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");


// Verificar si el parámetro `id` está presente
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Preparar la consulta SQL para eliminar el producto
  $sql = "DELETE FROM productos WHERE id_producto = ?";
  $stmt = $pdo->prepare($sql);

  // Ejecutar la consulta
  if ($stmt->execute([$id])) {
    echo "Producto eliminado correctamente.";
  } else {
    echo "Error al eliminar el producto.";
  }
}
?>

