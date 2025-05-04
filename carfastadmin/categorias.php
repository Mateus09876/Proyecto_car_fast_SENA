<?php
include 'datos.php';

$categoria = $_GET['cat'] ?? '';
$categoria = str_replace('_', ' ', strtolower($categoria));

if (isset($datos[$categoria])) {
    echo "<h3>" . ucwords($categoria) . "</h3><ul>";
    foreach ($datos[$categoria] as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
} else {
    echo "Categoría no encontrada.";
}
