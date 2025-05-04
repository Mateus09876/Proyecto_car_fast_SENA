function registrar() {
    const identificacion = document.getElementById('identificacion').value;
    const nombre = document.getElementById('nombre').value;
    const apellidos = document.getElementById('apellidos').value;
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;

    // Validación básica
    if (!identificacion || !nombre || !apellidos || !correo || !password) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    // Crear objeto con los datos
    const datos = {
        identificacion,
        nombre,
        apellidos,
        correo,
        password
    };

    // Enviar datos al servidor usando fetch
    fetch('registrar_cliente.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Muestra la respuesta del servidor en la consola
        alert("Registro exitoso. ¡Bienvenido!");
        window.location.href = "car_fast.html"; // Redirección correcta al inicio de sesión
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Error al registrar. Intente más tarde.");
    });
}

