<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Configuración de conexión
$host = '127.0.0.1';
$usuario = 'root';
$contrasena = '';
$puerto = 3307;
$base_datos = 'car_fast';

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos, $puerto);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos JSON
$datos = json_decode(file_get_contents("php://input"), true);

if (!isset($datos['correo']) || !isset($datos['password'])) {
    echo "Faltan datos.";
    exit;
}

$correo = trim($datos['correo']);
$password = trim($datos['password']);

// Preparar la consulta para evitar inyección SQL
$stmt = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado && $resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificar la contraseña encriptada
    if (password_verify($password, $usuario['contraseña'])) {
        $_SESSION['correo'] = $correo;
        echo "success";
    } else {
        echo "Correo o contraseña incorrectos.";
    }
} else {
    echo "Correo o contraseña incorrectos.";
}

$stmt->close();
$conexion->close();
?>


