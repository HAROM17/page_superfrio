// Manejar el formulario de inicio de sesión
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("controller/controller.cliente.php?op=login_cliente", {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error en la respuesta del servidor.");
            }
            return response.text(); // Cambiado a `text` para manejar valores simples como "1", "0", "-1"
        })
        .then((data) => {
            console.log("Respuesta del servidor:", data); // Depuración
            if (data.trim() === "1") {
                // Recargar la misma página sin mostrar index.php en la URL
                window.location.reload();
            } else if (data.trim() === "0") {
                // Mostrar mensaje de error por credenciales incorrectas
                const alertDiv = document.getElementById("loginAlert");
                alertDiv.textContent = "Correo o contraseña incorrectos.";
                alertDiv.classList.remove("d-none");
            } else if (data.trim() === "-1") {
                // Mostrar mensaje de error por campos faltantes
                const alertDiv = document.getElementById("loginAlert");
                alertDiv.textContent = "Todos los campos son obligatorios.";
                alertDiv.classList.remove("d-none");
            }
        })
        .catch((error) => {
            console.error("Error en la solicitud:", error);
        });
});



// Al abrir el modal, asegura que el parámetro `e` sea correcto
const openModalButton = document.getElementById("openModalButton");
if (openModalButton) {
    openModalButton.addEventListener("click", function () {
        const empId = 1; // ID predeterminado o el ID que corresponde
        const empInput = document.getElementById("emp_id");
        if (empInput) {
            empInput.value = empId;
        }

        // Agregar o actualizar el parámetro `e` en la URL
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set("e", empId);
        window.history.pushState({}, "", currentUrl);

        // Guardar el ID de la empresa en localStorage
        localStorage.setItem("empresa_id", empId);
    });
}

// Al cerrar el modal, elimina el parámetro `e`
const authModal = document.getElementById("authModal");
if (authModal) {
    authModal.addEventListener("hidden.bs.modal", function () {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.delete("e");
        window.history.pushState({}, "", currentUrl);
    });
}

// Verificar el parámetro `e` en la URL al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const empIdFromUrl = urlParams.get("e");

    // Validar que el ID de la empresa sea válido
    if (empIdFromUrl && empIdFromUrl !== "1") {
        // Si el parámetro `e` no es válido, corrige la URL
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set("e", 1); // Restablecer al valor correcto
        window.history.replaceState({}, "", currentUrl);
    }

    // Asegurar que el ID de la empresa esté en el campo oculto
    const empId = localStorage.getItem("empresa_id") || 1;
    const empInput = document.getElementById("emp_id");
    if (empInput) {
        empInput.value = empId;
    }
});


/////////////////////////////////////////////////


function init() {}

// Inicializar después de que el documento esté listo
$(document).ready(function () {});

// Manejo de autenticación con Google
function handleCredentialResponse(response) {
    const token = response.credential;

    if (!token) {
        console.error("Token no recibido.");
        return;
    }

    // Decodificar token de Google
    const decodedToken = decodeJwtResponse(token);

    if (!decodedToken) {
        console.error("No se pudo decodificar el token.");
        return;
    }

    const correo = decodedToken.email;
    const nombre = decodedToken.given_name || "";
    const apellido = decodedToken.family_name || "";
    const foto = decodedToken.picture || "";

    console.log("Datos decodificados:", { correo, nombre, apellido, foto });

    // Detectar pestaña activa (login o register)
    const activeTab = document.querySelector("#authTabContent .tab-pane.active");

    if (activeTab && activeTab.id === "login") {
        // Si está en la pestaña de "Iniciar Sesión"
        loginWithGoogle(correo);
    } else if (activeTab && activeTab.id === "register") {
        // Si está en la pestaña de "Crear Cuenta"
        registerWithGoogle(nombre, apellido, correo, foto);
    } else {
        console.error("No se pudo determinar la pestaña activa.");
    }
}

// Función de inicio de sesión con Google
function loginWithGoogle(correo) {
    $.ajax({
        url: "controller/controller.cliente.php?op=acceso_google",
        type: "POST",
        data: {
            cli_correo: correo,
            emp_id: document.getElementById("emp_id").value,
        },
        success: function (data) {
            if (data.trim() === "1") {
                // Redirigir tras éxito
                window.location.reload();
            } else {
                const alertDiv = document.getElementById("loginAlert");
                alertDiv.textContent = "La cuenta no está registrada.";
                alertDiv.classList.remove("d-none");
                setTimeout(() => alertDiv.classList.add("d-none"), 5000);
            }
        },
        error: function (error) {
            console.error("Error en la solicitud AJAX (inicio de sesión):", error);
        },
    });
}

// Función de registro con Google
function registerWithGoogle(cli_nom, cli_ape, cli_correo, cli_img) {
    fetch("controller/controller.cliente.php?op=register_cliente_google", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            cli_nom: cli_nom,
            cli_ape: cli_ape,
            cli_correo: cli_correo,
            cli_img: cli_img,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Cuenta creada exitosamente. Ahora puedes iniciar sesión.");

                // Cambiar a la pestaña de inicio de sesión
                document.getElementById("login-tab").click();
            } else {
                const alertDiv = document.getElementById("loginAlert3");
                alertDiv.textContent = data.message || "Error al registrar la cuenta.";
                alertDiv.classList.remove("d-none");
                setTimeout(() => alertDiv.classList.add("d-none"), 5000);
            }
        })
        .catch((error) => {
            console.error("Error en la solicitud de registro:", error);
        });
}

// Decodificar token JWT de Google
function decodeJwtResponse(token) {
    try {
        const base64Url = token.split(".")[1];
        const base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
        const jsonPayload = decodeURIComponent(
            atob(base64)
                .split("")
                .map((c) => "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2))
                .join("")
        );
        return JSON.parse(jsonPayload);
    } catch (error) {
        console.error("Error al decodificar el JWT:", error);
        return null;
    }
}


init();
