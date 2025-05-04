function registrar(event) {
    event.preventDefault();

    const identificacion = document.getElementById("identificacion").value.trim();
    const nombre = document.getElementById("nombre").value.trim();
    const apellidos = document.getElementById("apellidos").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmarPassword = document.getElementById("confirmarPassword").value.trim();

    if (!correo.includes("@")) {
        alert("Ingrese un correo válido.");
        return;
    }

    if (password !== confirmarPassword) {
        alert("Las contraseñas no coinciden.");
        return;
    }

    const datos = {
        identificacion,
        nombre,
        apellidos,
        correo,
        password
    };

    fetch("http://localhost/car_fast/registro_cliente/registro.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(datos)
    })
    .then(res => res.text())
    .then(data => {
        console.log("Respuesta:", data);
        if (data.trim() === "success") {
            alert("¡Registro exitoso!");
            window.location.href = "../inicio_sesion/car_fast.html";
        } else {
            alert(data);
        }
    })
    .catch(err => {
        console.error("Error:", err);
        alert("Error de conexión con el servidor.");
    });
}
