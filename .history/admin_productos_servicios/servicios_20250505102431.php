<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

// Procesar el formulario para agregar un servicio
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare("INSERT INTO servicios (nombre, descripcion, precio, categoria) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria]);

    header("Location: servicios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestionar servicios - Car Fast</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <div class="admin-panel">
    <h1>Gestionar servicios - Car Fast</h1>

    <!-- Formulario para agregar un nuevo servicio -->
    <div class="form-register">
      <h4>Agregar Nuevo Servicio</h4>
      <form method="POST" action="servicios.php">
        <input type="text" name="nombre" placeholder="Nombre del Servicio" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <select name="categoria" required>
          <option value="Radios y Sistemas Multimedia">Radios y Sistemas Multimedia</option>
          <option value="Neumáticos">Neumáticos</option>
          <option value="Accesorios">Accesorios</option>
          <option value="Otros">Otros</option>
        </select>
        <button type="submit" class="botons">Agregar Servicio</button>
      </form>
      <br><br>
      
        <a href="index.html" style="display:inline-block; margin-bottom:10px; padding:8px 16px; background-color:#007BFF; color:white; text-decoration:none; border-radius:4px;">← Regresar</a>
      
      </div>

    <!-- Tabla para ver y editar servicios existentes -->
    <h4>Lista de Servicios</h4>
    <table border="1">
      <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Categoría</th>
        <th>Acciones</th>
      </tr>
      <?php
        $stmt = $pdo->query("SELECT * FROM servicios ORDER BY id_servicio DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>
                  <td>{$row['nombre']}</td>
                  <td>{$row['descripcion']}</td>
                  <td>{$row['precio']}</td>
                  <td>{$row['categoria']}</td>
                  <td>
                    <a href='editar_servicio.php?id={$row['id_servicio']}'>Editar</a> | 
                    <a href='eliminar_servicio.php?id={$row['id_servicio']}' onclick=\"return confirm('¿Seguro que deseas eliminar este servicio?');\">Eliminar</a>
                    
                  </td>
                </tr>";
        }
      ?>
    </table>
  </div>
</body>
</html>
