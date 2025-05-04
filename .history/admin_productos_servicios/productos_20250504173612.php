<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

    // Capturar datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    // Preparar y ejecutar la consulta para insertar el producto
    $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria]);

    // Mostrar mensaje de éxito y redirigir con un pequeño retraso
    echo "<script>alert('Producto agregado correctamente.');</script>";
    echo "<script>window.location.href = 'productos.html';</script>"; // Redirigir a productos.html
    exit();
}
?>



