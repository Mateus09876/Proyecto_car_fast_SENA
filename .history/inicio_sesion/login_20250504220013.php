<?php
// Configuración de la base de datos
$host = 'localhost'; // Dirección del servidor
$dbname = 'car_fast'; // Nombre de la base de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos

// Conectar a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
    exit;
}

// Obtener los datos del cliente
$data = json_decode(file_get_contents('php://input'), true);
$correo = $data['correo'] ?? '';
$password = $data['password'] ?? '';

// Verificar si el correo y la contraseña no están vacíos
if (empty($correo) || empty($password)) {
    echo "Por favor, ingrese el correo y la contraseña.";
    exit;
}

// Preparar y ejecutar la consulta para verificar las credenciales
$sql = "SELECT * FROM clientes WHERE correo = :correo";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt->execute();

// Verificar si se encontró el cliente
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    // Comparar la contraseña ingresada con la almacenada en la base de datos
    if (password_verify($password, $usuario['contraseña'])) {
        // Si las credenciales son correctas, devolver "success"
        echo "success";
    } else {
        // Si la contraseña es incorrecta
        echo "Contraseña incorrecta.";
    }
} else {
    // Si no se encontró el usuario
    echo "Correo no registrado.";
}
?>
