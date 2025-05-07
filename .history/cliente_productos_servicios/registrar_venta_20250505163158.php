<?php
// Permitir solo solicitudes POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Método no permitido
    echo "Método no permitido";
    exit;
}

// Leer el cuerpo JSON
$input = json_decode(file_get_contents('php://input'), true);

// Validar campos necesarios
if (
    empty($input['nombre']) ||
    empty($input['telefono']) ||
    empty($input['item']) ||
    empty($input['precio']) ||
    empty($input['tipo'])
) {
    http_response_code(400);
    echo "Datos incompletos";
    exit;
}

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "car_fast", 3307);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Preparar datos
$nombre = $conexion->real_escape_string($input['nombre']);
$telefono = $conexion->real_escape_string($input['telefono']);
$item = $conexion->real_escape_string($input['item']);
$precio = floatval($input['precio']);
$tipo = $conexion->real_escape_string($input['tipo']);

// Insertar en la tabla ventas
$sql = "INSERT INTO ventas (nombre_cliente, telefono, item, precio, tipo)
        VALUES ('$nombre', '$telefono', '$item', $precio, '$tipo')";

if ($conexion->query($sql) === TRUE) {
    echo "Venta registrada correctamente";
} else {
    http_response_code(500);
    echo "Error al registrar: " . $conexion->error;
}

$conexion->close();
?>
