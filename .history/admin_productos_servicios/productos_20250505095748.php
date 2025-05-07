<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

// Procesar el formulario para agregar un producto
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria]);

    // Redirigir para evitar reenvío del formulario
    header("Location: productos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestionar Productos - Car Fast</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <div class="admin-panel">
    <h1>Gestionar Productos - Car Fast</h1>

    <!-- Formulario para agregar un nuevo producto -->
    <div class="form-register">
      <h4>Agregar Nuevo Producto</h4>
      <form method="POST" action="productos.php">
        <input type="text" name="nombre" placeholder="Nombre del Producto" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <select name="categoria" required>
          <option value="Radios y Sistemas Multimedia">Radios y Sistemas Multimedia</option>
          <option value="Neumáticos">Neumáticos</option>
          <option value="Accesorios">Accesorios</option>
          <option value="Otros">Otros</option>
        </select>
        <button type="submit" class="botons">Agregar Producto</button>
      </form>
      <br><br>
        <button type="button" onclick="window.location.href='car_fast/inicio_sesion/car_fast.html'">Cancelar</button><br><br>
        <button type="reset">Limpiar</button><br><br>
        <a href="car_fast/inicio_sesion/car_fast.html" style="display:inline-block; margin-bottom:10px; padding:8px 16px; background-color:#007BFF; color:white; text-decoration:none; border-radius:4px;">← Salir</a>
        
    </div>

    <!-- Tabla para ver y editar productos existentes -->
    <h4>Lista de Productos</h4>
    <table border="1">
      <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Categoría</th>
        <th>Acciones</th>
      </tr>
      <?php
        $stmt = $pdo->query("SELECT * FROM productos ORDER BY id_producto DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>
                  <td>{$row['nombre']}</td>
                  <td>{$row['descripcion']}</td>
                  <td>{$row['precio']}</td>
                  <td>{$row['categoria']}</td>
                  <td>
                    <a href='editar_producto.php?id={$row['id_producto']}'>Editar</a> | 
                    <a href='eliminar_producto.php?id={$row['id_producto']}'>Eliminar</a>
                  </td>
                </tr>";
        }
      ?>
    </table>
  </div>
</body>
</html>




