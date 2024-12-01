
// Manejar el formulario de registro manual
document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("controller/controller.cliente.php?op=register_cliente", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("Respuesta del servidor:", data);

            if (data.success) {
                // Cambiar automáticamente a la pestaña "Iniciar Sesión"
                const loginTab = document.getElementById("login-tab"); // Seleccionar el botón de la pestaña de "Iniciar Sesión"
                const registerTab = document.getElementById("register-tab");

                // Activar la pestaña de "Iniciar Sesión"
                loginTab.classList.add("active");
                registerTab.classList.remove("active");

                // Cambiar el contenido visible
                document.getElementById("login").classList.add("show", "active");
                document.getElementById("register").classList.remove("show", "active");

                // Limpia los campos del formulario
                document.getElementById("registerForm").reset();

                // Mostrar un mensaje de éxito
                const loginAlert2 = document.getElementById("loginAlert2");
                loginAlert2.textContent = "Cuenta creada exitosamente. Por favor, inicia sesión.";
                loginAlert2.classList.remove("d-none");

                // Ocultar el mensaje después de 2 segundos
                setTimeout(() => {
                    loginAlert2.classList.add("d-none");
                }, 5000);
            } else {
                // Mostrar mensaje de error en `loginAlert` debajo del formulario
                const loginAlert = document.getElementById("loginAlert3");
                loginAlert.textContent = data.message || "El correo ya está registrado. Intenta con otro.";
                loginAlert.classList.remove("d-none");

                // Ocultar el mensaje de error después de 5 segundos (opcional)
                setTimeout(() => {
                    loginAlert.classList.add("d-none");
                }, 5000);
            }
        })
        .catch((error) => {
            console.error("Error en la solicitud:", error);
        });
});
