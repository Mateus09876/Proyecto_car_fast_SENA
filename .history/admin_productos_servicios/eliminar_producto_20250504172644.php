<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

    // Eliminar el producto
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id_producto = ?");
    $stmt->execute([$id]);

    // Redirigir después de la eliminación
    header('Location: productos.html');
    exit();
} else {
    echo "No se proporcionó un ID válido.";
    exit();
}


