

        // Redirigir de vuelta al formulario
        header("Location: servicios.html");
        exit();
    }

} catch (PDOException $e) {
    echo "Error de conexión o ejecución: " . $e->getMessage();
}
?>
