<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");


// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recoger los datos del formulario
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];

  // Preparar la consulta SQL para insertar el nuevo producto
  $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria) VALUES (?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);

  // Ejecutar la consulta con los valores del formulario
  if ($stmt->execute([$nombre, $descripcion, $precio, $categoria])) {
    echo "Producto agregado correctamente.";
  } else {
    echo "Error al agregar el producto.";
  }
}

?>
