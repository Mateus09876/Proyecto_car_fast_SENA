<?php
$host = "localhost";
$dbname = "car_fast";
$username = "root";
$password = "";

$datos = json_decode(file_get_contents("php://input"), true);

if (
    isset($datos['identificacion'], $datos['nombre'], $datos['apellidos'],
    $datos['correo'], $datos['password'])
) {
    $identificacion = trim($datos['identificacion']);
    $nombre = trim($datos['nombre']);
    $apellidos = trim($datos['apellidos']);
    $correo = trim($datos['correo']);
    $password_plain = trim($datos['password']);

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Correo no válido";
        exit;
    }

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE correo = ?");
        $stmt->execute([$correo]);

        if ($stmt->rowCount() > 0) {
            echo "El correo ya está registrado";
            exit;
        }

        $password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO clientes (identificacion, nombre, apellido, correo, contraseña, fecha_registro)
                               VALUES (?, ?, ?, ?, ?, NOW())");

        $stmt->execute([$identificacion, $nombre, $apellidos, $correo, $password_hash]);

        echo "success";
    } catch (PDOException $e) {
        echo "Error en el servidor: " . $e->getMessage();
    }
} else {
    echo "Faltan datos";
}
?>






