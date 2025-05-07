<?php
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare("UPDATE servicios SET nombre = ?, descripcion = ?, precio = ?, categoria = ? WHERE id_servicio = ?");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria, $id]);

    echo "<script>alert('Servicio actualizado correctamente'); window.location.href='servicios.php';</script>";
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
            <select name="categoria" required>
              <option value="Radios y Sistemas Multimedia" <?php if ($servicio['categoria'] == "Radios y Sistemas Multimedia") echo 'selected'; ?>>Radios y Sistemas Multimedia</option>
              <option value="Neumáticos" <?php if ($servicio['categoria'] == "Neumáticos") echo 'selected'; ?>>Neumáticos</option>
              <option value="Accesorios" <?php if ($servicio['categoria'] == "Accesorios") echo 'selected'; ?>>Accesorios</option>
              <option value="Otros" <?php if ($servicio['categoria'] == "Otros") echo 'selected'; ?>>Otros</option>
            </select>
            <button type="submit" class="botons">Actualizar Servicio</button>
            <br><br>
        <br><br>
        <button type="button" onclick="window.location.href='index.html'">Cancelar</button><br><br>
        <button type="reset">Limpiar</button><br><br>
        <a href="index.html" style="display:inline-block; margin-bottom:10px; padding:8px 16px; background-color:#007BFF; color:white; text-decoration:none; border-radius:4px;">← Regresar</a>
        <a href="productos.php" style="display:inline-block; margin-bottom:10px; padding:8px 16px; background-color:#007BFF; color:white; text-decoration:none; border-radius:4px;">← Regresar</a>
        
        </form>
    </div>
</body>
</html>
