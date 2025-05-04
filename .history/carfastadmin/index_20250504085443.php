<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Car Fast - Panel Administrador</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contenedor">
        <h2>Car Fast - Productos y Servicios</h2>
        <div class="botones">
            <?php
            $categorias = ["Radios y sistemas Multimedia", "Luces e iluminación", "Audio", "Alarmas y seguridad", "Pitos", "Seguros puertas", "Electricidad y componentes", "Accesorios", "Servicios"];
            foreach ($categorias as $categoria) {
                $valor = urlencode(strtolower(str_replace(' ', '_', $categoria)));
                echo "<button onclick=\"mostrarCategoria('$valor')\">$categoria</button>";
            }
            ?>
        </div>
        <div id="resultado" class="resultado"></div>
    </div>

    <script>
        function mostrarCategoria(categoria) {
            fetch("categorias.php?cat=" + categoria)
                .then(res => res.text())
                .then(data => {
                    document.getElementById("resultado").innerHTML = data;
                });
        }
    </script>
</body>
</html>
