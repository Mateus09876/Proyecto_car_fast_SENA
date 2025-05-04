<?php
// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=car_fast", "root", "");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se recibieron datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $categoria = $_POST["categoria"];

        // Insertar en la base de datos
        $sql = "INSERT INTO servicios (nombre, descripcion, precio, categoria) 
                VALUES (:nombre, :descripcion, :precio, :categoria)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':categoria' => $categoria
        ]);

        // Redirigir de vuelta al formulario
        header("Location: servicios.html");
        exit();
    }

} catch (PDOException $e) {
    echo "Error de conexión o ejecución: " . $e->getMessage();
}
?>
