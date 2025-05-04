<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;dbname=car_fast", "root", "");

// Verificar si se recibió un ID por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del servicio a editar
    $stmt = $pdo->prepare("SELECT * FROM servicios WHERE id_servicio = ?");
    $stmt->execute([$id]);
    $servicio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$servicio) {
        echo "Servicio no encontrado.";
        exit;
    }
} else {
    echo "ID de servicio no proporcionado.";
    exit;
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $stmt = $pdo->prepare("UPDATE servicios SET nombre = ?, descripcion = ?, precio = ? WHERE id_servicio = ?");
    $stmt->execute([$nombre, $descripcion, $precio, $id]);

    echo "<script>alert('Servicio actualizado correctamente'); window.location.href='servicios.html';</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Servicio - Car Fast</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="form-register">
        <h4>Editar Servicio</h4>
        <form method="POST">
            <input type="text" name="nombre" value="<?php echo $servicio['nombre']; ?>" required>
            <input type="text" name="descripcion" value="<?php echo $servicio['descripcion']; ?>" required>
            <input type="number" step="0.01" name="precio" value="<?php echo $servicio['precio']; ?>" required>
            <button type="submit" class="botons">Actualizar Servicio</button>
        </form>
    </div>
</body>
</html>
