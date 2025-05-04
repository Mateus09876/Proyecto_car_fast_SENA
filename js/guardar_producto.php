<?php
$conexion = new mysqli("localhost", "root", "", "car_fast", 3307);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$categoria = $_POST['categoria'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

$imagen = $_FILES['imagen']['name'];
$ruta = "imagenes/" . basename($imagen);

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
    $sql = "INSERT INTO productos (categoria, nombre, descripcion, precio, imagen)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssds", $categoria, $nombre, $descripcion, $precio, $ruta);
    $stmt->execute();
    $stmt->close();
    echo "✅ Producto agregado correctamente. <a href='panel_admin.php'>Volver</a>";
} else {
    echo "❌ Error al subir la imagen.";
}

$conexion->close();
?>
