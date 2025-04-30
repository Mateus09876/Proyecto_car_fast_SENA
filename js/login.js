document.getElementById("form-login").addEventListener("submit", function(e) {
    e.preventDefault(); // Evita que se mande normal

    const correo = document.getElementById("correo").value;
    const password = document.getElementById("password").value;

    fetch('http://localhost/car_fast/login.php', {

        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ correo: correo, password: password })
    })
    .then(response => response.text())
    .then(data => {
        console.log("Respuesta del servidor:", data);

        if (data.trim() === "success") {
            window.location.href = "car_fast.html"; // Redirige a tu página principal
        } else {
            alert(data);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error al iniciar sesión. Intente de nuevo más tarde.");
    });
});
