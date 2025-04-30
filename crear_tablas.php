<?php
// Conectar a la base de datos
$conexion = new mysqli('127.0.0.1', 'root', '', '', 3307);




// Verificar conexión
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Crear la base de datos car_fast
$sql = "CREATE DATABASE IF NOT EXISTS car_fast";
if ($conexion->query($sql) === TRUE) {
    echo "Base de datos 'car_fast' creada o ya existente.<br>";
} else {
    die("Error al crear la base de datos: " . $conexion->error);
}

// Seleccionar la base de datos
$conexion->select_db('car_fast');

// Crear tabla de clientes
$sql = "CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    identificacion VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    direccion VARCHAR(150),
    contraseña VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conexion->query($sql) === TRUE) {
    echo "Tabla 'clientes' creada.<br>";
} else {
    echo "Error creando tabla 'clientes': " . $conexion->error . "<br>";
}

// Crear tabla de administradores
$sql = "CREATE TABLE IF NOT EXISTS administradores (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    nombre_completo VARCHAR(100)
)";
if ($conexion->query($sql) === TRUE) {
    echo "Tabla 'administradores' creada.<br>";
} else {
    echo "Error creando tabla 'administradores': " . $conexion->error . "<br>";
}

// Crear tabla de productos
$sql = "CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255)
)";
if ($conexion->query($sql) === TRUE) {
    echo "Tabla 'productos' creada.<br>";
} else {
    echo "Error creando tabla 'productos': " . $conexion->error . "<br>";
}

// Crear tabla de ventas
$sql = "CREATE TABLE IF NOT EXISTS ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_producto INT,
    cantidad INT DEFAULT 1,
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
)";
if ($conexion->query($sql) === TRUE) {
    echo "Tabla 'ventas' creada.<br>";
} else {
    echo "Error creando tabla 'ventas': " . $conexion->error . "<br>";
}

// Crear tabla de citas
$sql = "CREATE TABLE IF NOT EXISTS citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    servicio VARCHAR(100),
    estado VARCHAR(50) DEFAULT 'Pendiente',
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
)";
if ($conexion->query($sql) === TRUE) {
    echo "Tabla 'citas' creada.<br>";
} else {
    echo "Error creando tabla 'citas': " . $conexion->error . "<br>";
}

// Cerrar la conexión
$conexion->close();
?>

