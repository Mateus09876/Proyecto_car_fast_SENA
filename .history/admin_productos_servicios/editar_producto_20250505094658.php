<?php
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id_producto = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, categoria=? WHERE id_producto=?");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria, $_POST['id']]);

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
    <form method="POST">
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
        <button type="submit" name="actualizar">Actualizar</button>
        <a href="../admin_productos_servicios/index.html" style="display:inline-block; margin-bottom:10px; padding:8px 16px; background-color:#007BFF; color:white; text-decoration:none; border-radius:4px;">← Regresar al panel</a>

    </form>
</body>
</html>

