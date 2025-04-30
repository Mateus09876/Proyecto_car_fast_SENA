<?php
// Configuración de conexión
$host = '127.0.0.1';
$usuario = 'root';
$contrasena = '';
$puerto = 3307; // Puerto correcto
$base_datos = 'car_fast';

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos, $puerto);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Este archivo solo conecta, no procesa datos.
?>
