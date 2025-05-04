document.getElementById('formLogin').addEventListener('submit', function(e) {
    e.preventDefault();

    const correo = document.getElementById('correo').value;
    const contraseña = document.getElementById('contraseña').value;

    fetch('login_admin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ correo, contraseña })
    })
    .then(res => res.text())
    .then(data => {
        if (data === "success") {
            window.location.href = "../admin_panel/index.html"; // redirige al panel del admin
        } else {
            document.getElementById('mensaje').innerText = data;
        }
    });
});
