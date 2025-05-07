<?php
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id_producto = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    // Manejo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $nombre_imagen = basename($_FILES['imagen']['name']);
        $ruta_imagen = 'imagenes/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
    } else {
        // Si no se carga nueva imagen, usar la actual
        $ruta_imagen = $producto['imagen'];
    }

    // Actualizar en la base de datos
    $stmt = $pdo->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, categoria=?, imagen=? WHERE id_producto=?");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria, $ruta_imagen, $id]);

    header("Location: productos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $producto['id_producto']; ?>">
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required><br>
        <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required><br>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required><br>

        <select name="categoria" required>
            <option value="Radios y Sistemas Multimedia" <?php if($producto['categoria'] == 'Radios y Sistemas Multimedia') echo 'selected'; ?>>Radios y Sistemas Multimedia</option>
            <option value="Neumáticos" <?php if($producto['categoria'] == 'Neumáticos') echo 'selected'; ?>>Neumáticos</option>
            <option value="Accesorios" <?php if($producto['categoria'] == 'Accesorios') echo 'selected'; ?>>Accesorios</option>
            <option value="Otros" <?php if($producto['categoria'] == 'Otros') echo 'selected'; ?>>Otros</option>
        </select><br>

        <!-- Mostrar imagen actual -->
        <?php if (!empty($producto['imagen'])): ?>
            <p>Imagen actual:</p>
            <img src="<?php echo $producto['imagen']; ?>" alt="Imagen del producto" width="120"><br>
        <?php endif; ?>

        <!-- Subir nueva imagen -->
        <label for="imagen">Cambiar imagen:</label>
        <input type="file" name="imagen" accept="image/*"><br><br>

        <button type="submit" name="actualizar">Actualizar</button>
        <br><br>
        <a href="productos.php" style="display:inline-block; margin-bottom:10px; padding:8px 16px; background-color:#007BFF; color:white; text-decoration:none; border-radius:4px;">← Regresar</a>
    </form>
</body>
</html>




