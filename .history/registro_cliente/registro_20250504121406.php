$correo = trim($datos['correo']);

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "Correo no válido";
    exit;
}




