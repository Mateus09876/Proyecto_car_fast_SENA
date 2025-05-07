<?php
// Permitir todas las fuentes (debe ser ajustado según tus necesidades)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// login.php en /car_fast/registro_cliente/
header('Content-Type: text/plain');

$data = json_decode(file_get_contents("php://input"), true);
$correo = $data['correo'] ?? '';
$password = $data['password'] ?? '';

try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE correo = ?");
    $stmt->execute([$correo]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente && password_verify($password, $cliente['contraseña'])) {
        echo "success";
    } else {
        echo "Correo o contraseña incorrectos";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
