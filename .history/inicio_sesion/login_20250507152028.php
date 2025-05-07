<?php
// login.php en /car_fast/registro_cliente/
header('Content-Type: text/plain');

$data = json_decode(file_get_contents("php://input"), true);
$correo = $data['correo'] ?? '';
$password = $data['password'] ?? '';

try {
    // Cambié 'localhost' por '192.168.0.18'
    $pdo = new PDO("mysql:host=192.168.0.18;port=3307;dbname=car_fast;charset=utf8", "root", "");
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

