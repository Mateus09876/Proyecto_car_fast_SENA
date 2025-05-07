<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

// Procesar el formulario para agregar un servicio
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare("INSERT INTO servicios (nombre, descripcion, precio, categoria) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria]);

    // Redirigir para evitar reenvío del formulario
    header("Location: servicios.php");
    exit();
}
