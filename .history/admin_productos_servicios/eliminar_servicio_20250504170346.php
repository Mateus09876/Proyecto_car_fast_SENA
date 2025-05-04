<?php
// Verificar si se proporcionó un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos
    $pdo = new PDO("mysql:host=localhost;dbname=car_fast", "root", "");

    // Eliminar el servicio con ese ID
    $stmt = $pdo->prepare("DELETE FROM servicios WHERE id_servicio = ?");
    $stmt->execute([$id]);

    // Redirigir de nuevo a la página de servicios
    header("Location: servicios.html");
    exit;
} else {
    echo "ID de servicio no proporcionado.";
    exit;
}
