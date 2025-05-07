<?php
// login.php en /car_fast/registro_cliente/

header('Content-Type: text/plain');

// Leer los datos enviados desde la solicitud POST en formato JSON
$data = json_decode(file_get_contents("php://input"), true);
$correo = $data['correo'] ?? '';
$password = $data['password'] ?? '';

if (!$correo || !$password) {
    echo "Por favor ingresa correo y contraseña";
    exit;
}

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buscar el cliente por correo
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE correo = ?");
    $stmt->execute([$correo]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el cliente existe y la contraseña es correcta
    if ($cliente && password_verify($password, $cliente['contraseña'])) {
        echo "success"; // Si todo es correcto
    } else {
        echo "Correo o contraseña incorrectos"; // Si hay algún error
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage(); // Si hay algún problema con la base de datos
}
?>
