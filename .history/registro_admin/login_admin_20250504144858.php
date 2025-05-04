<?php
$host = "localhost";
$dbname = "car_fast";
$username = "root";
$password = "";

$datos = json_decode(file_get_contents("php://input"), true);

if (isset($datos['correo'], $datos['contraseña'])) {
    $correo = $datos['correo'];
    $contraseña = $datos['contraseña'];

    try {
        $pdo = new PDO("mysql:host=$host;port=3307;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM administrador WHERE correo = ?");
        $stmt->execute([$correo]);

        if ($stmt->rowCount() === 1) {
            $admin = $stmt->fetch();
            if (password_verify($contraseña, $admin['contraseña'])) {
                echo "success";
                exit;
            } else {
                echo "Contraseña incorrecta";
                exit;
            }
        } else {
            echo "Administrador no encontrado";
            exit;
        }

    } catch (PDOException $e) {
        echo "Error de conexión";
    }
} else {
    echo "Datos incompletos";
}
?>
