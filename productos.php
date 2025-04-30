<?php
session_start();

// Verificar si el correo está en la sesión
if (!isset($_SESSION['correo'])) {
    header('Location: login.html'); // Redirigir a la página de login si no ha iniciado sesión
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Car Fast - Productos y Servicios</title>
    <script type="text/javascript" src="js/index.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"></script>
    <style>
        /* Aquí puedes colocar tus estilos como lo tienes actualmente */
    </style>
</head>
<body>
    <!-- Aquí sigue tu HTML como está, ya que la validación de sesión está hecha en PHP -->
</body>
</html>
