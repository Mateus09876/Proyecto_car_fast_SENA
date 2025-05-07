<?php
$host = 'localhost';
$db   = 'car_fast';
$user = 'root';
$pass = '';
$port = '3307';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Usa el nombre correcto de columna, por ejemplo: id_venta
        $stmt = $pdo->prepare("UPDATE ventas SET confirmado = 1 WHERE id_venta = ?");
        $stmt->execute([$id]);

        echo "Venta confirmada correctamente.";
    } else {
        echo "ID de venta no recibido.";
    }

} catch (PDOException $e) {
    echo "Error al confirmar venta: " . $e->getMessage();
}
?>
