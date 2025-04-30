<?php
include 'conexion.php'; // Conectar a la base de datos

// Recibir datos en formato JSON
$datos = json_decode(file_get_contents('php://input'), true);

if ($datos) {
    // Extraer los datos
    $identificacion = $datos['identificacion'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellidos'];
    $correo = $datos['correo'];
    $password = password_hash($datos['password'], PASSWORD_DEFAULT); // Encriptar contraseña

    // Preparar sentencia SQL para evitar inyección
    $stmt = $conn->prepare("INSERT INTO clientes (identificacion, nombre, apellido, correo, contraseña) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        // Enlazar parámetros
        $stmt->bind_param("sssss", $identificacion, $nombre, $apellido, $correo, $password);

        // Ejecutar
        if ($stmt->execute()) {
            echo "Cliente registrado exitosamente.";
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

} else {
    echo "No se recibieron datos válidos.";
}

$conn->close();
?>



