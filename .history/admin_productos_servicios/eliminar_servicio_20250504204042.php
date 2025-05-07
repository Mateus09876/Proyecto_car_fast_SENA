<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");
    $stmt = $pdo->prepare("DELETE FROM servicios WHERE id_servicio = ?");
    $stmt->execute([$id]);

    header("Location: servicios.php");
    exit;
} else {
    echo "ID de servicio no proporcionado.";
    exit;
}

