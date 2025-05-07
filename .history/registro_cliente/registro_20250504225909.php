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

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

// Verificar si los campos están completos
if (empty($nombre) || empty($apellido) || empty($correo) || empty($password)) {
    echo "Por favor, complete todos los campos.";
    exit;
}

// Verificar si el correo ya está registrado
$sql = "SELECT * FROM clientes WHERE correo = :correo";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "El correo ya está registrado.";
    exit;
}

// Encriptar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar los datos en la base de datos
$sql = "INSERT INTO clientes (nombre, apellido, correo, contraseña) VALUES (:nombre, :apellido, :correo, :contraseña)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
$stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt->bindParam(':contraseña', $hashed_password, PDO::PARAM_STR);

if ($stmt->execute()) {
    // Si el registro es exitoso, redirigir al cliente
    header("Location: /car_fast/inicio.php"); // Redirige a la página principal
    exit;
} else {
    echo "Error al registrar el usuario. Intente de nuevo más tarde.";
}
?>







