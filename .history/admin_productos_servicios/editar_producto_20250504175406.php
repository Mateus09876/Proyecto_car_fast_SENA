<?php
// Verificar si se pasa un ID de producto
if (isset($_GET['id'])) {
  $id_producto = $_GET['id'];

  // Conectar a la base de datos
  $pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");


  // Preparar la consulta para obtener los datos del producto
  $stmt = $pdo->prepare("SELECT * FROM productos WHERE id_producto = ?");
  $stmt->execute([$id_producto]);

  // Obtener los datos del producto
  $producto = $stmt->fetch(PDO::FETCH_ASSOC);

  // Si el producto no existe, redirigir a la página de productos
  if (!$producto) {
    header("Location: productos.html");
    exit;
  }
} else {
  // Si no se pasa un ID, redirigir a la página de productos
  header("Location: productos.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];

  // Preparar la consulta para actualizar el producto
  $stmt = $pdo->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, categoria = ? WHERE id_producto = ?");
  $stmt->execute([$nombre, $descripcion, $precio, $categoria, $id_producto]);

  // Redirigir a la página de productos después de la actualización
  header("Location: productos.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto - Car Fast</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <div class="admin-panel">
    <h1>Editar Producto - Car Fast</h1>

    <!-- Formulario para editar el producto -->
    <div class="form-register">
      <h4>Editar Producto</h4>
      <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre del Producto" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        <input type="text" name="descripcion" placeholder="Descripción" value="<?php echo htmlspecialchars($producto['descripcion']); ?>" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
        <select name="categoria" required>
          <option value="Radios y Sistemas Multimedia" <?php echo ($producto['categoria'] == 'Radios y Sistemas Multimedia') ? 'selected' : ''; ?>>Radios y Sistemas Multimedia</option>
          <option value="Neumáticos" <?php echo ($producto['categoria'] == 'Neumáticos') ? 'selected' : ''; ?>>Neumáticos</option>
          <option value="Accesorios" <?php echo ($producto['categoria'] == 'Accesorios') ? 'selected' : ''; ?>>Accesorios</option>
          <option value="Otros" <?php echo ($producto['categoria'] == 'Otros') ? 'selected' : ''; ?>>Otros</option>
        </select>
        <button type="submit" class="botons">Actualizar Producto</button>
      </form>
    </div>

  </div>
</body>
</html>
