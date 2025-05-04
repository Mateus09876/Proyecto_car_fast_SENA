<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recibir los datos del formulario
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];

  // Conexión a la base de datos
  $pdo = new PDO("mysql:host=localhost;dbname=car_fast", "root", "");

  // Preparar la consulta para insertar el nuevo producto
  $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria) VALUES (?, ?, ?, ?)");
  $stmt->execute([$nombre, $descripcion, $precio, $categoria]);

  // Redirigir después de agregar el producto
  header("Location: productos.html");
  exit;
}
?>
