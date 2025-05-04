function registrar(event) {
    event.preventDefault(); // Evita recargar

    const identificacion = document.getElementById('identificacion').value.trim();
    const nombre = document.getElementById('nombre').value.trim();
    const apellidos = document.getElementById('apellidos').value.trim();
    const correo = document.getElementById('correo').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmarPassword = document.getElementById('confirmarPassword').value.trim();

    // Validación de campos vacíos
    if (!identificacion || !nombre || !apellidos || !correo || !password || !confirmarPassword) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Validación de formato de correo
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexCorreo.test(correo)) {
        alert("Ingrese un correo válido.");
        return;
    }

    // Validación de coincidencia de contraseñas
    if (password !== confirmarPassword) {
        alert("Las contraseñas no coinciden.");
        return;
    }

    const datos = { identificacion, nombre, apellidos, correo, password };

    fetch('http://localhost/car_fast/registro_cliente/registro.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            alert("Registro exitoso. Ahora puedes iniciar sesión.");
            window.location.href = "/car_fast/inicio_sesion/car_fast.html";
        } else {
            alert("Error al registrar: " + data);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error de conexión. Intenta más tarde.");
    });
}
