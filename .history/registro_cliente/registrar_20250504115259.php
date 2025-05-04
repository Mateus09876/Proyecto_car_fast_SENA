<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "car_fast", 3307);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibe los datos JSON
$data = json_decode(file_get_contents("php://input"), true);

$identificacion = $data['identificacion'];
$nombre = $data['nombre'];
$apellidos = $data['apellidos'];
$correo = $data['correo'];
$password = password_hash($data['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

// Verifica si el correo ya está registrado
$verificar = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
$verificar->bind_param("s", $correo);
$verificar->execute();
$resultado = $verificar->get_result();

if ($resultado->num_rows > 0) {
    echo "El correo ya está registrado.";
    exit;
}

// Inserta los datos
$sql = $conexion->prepare("INSERT INTO clientes (identificacion, nombre, apellido, correo, contraseña, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())");
$sql->bind_param("sssss", $identificacion, $nombre, $apellidos, $correo, $password);

if ($sql->execute()) {
    echo "success";
} else {
    echo "Error al registrar.";
}

$conexion->close();
?>



