document.addEventListener("DOMContentLoaded", function () {
    const accountLink = document.getElementById("accountLinkMovil");
    const FavoritosLink = document.getElementById("FavoritosLink");

    if (accountLink) {
        accountLink.addEventListener("click", function (event) {
            event.preventDefault();
            const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
            loginModal.show();
        });
    }

    if (FavoritosLink) {
        FavoritosLink.addEventListener("click", function (event) {
            event.preventDefault();
            if (isAuthenticated) {
                window.location.href = "favoritos.php";
            } else {
                const authModal = new bootstrap.Modal(document.getElementById("authModal"));
                authModal.show();
            }
        });
    }
});




document.addEventListener("DOMContentLoaded", function () {
    const loginPromptButton = document.getElementById("loginPromptButton");
    const loginPromptButton2 = document.getElementById("loginPromptButton2");
    const cartButton = document.getElementById("cartButton");

    // Botón para clientes no autenticados
    if (loginPromptButton) {
        loginPromptButton.addEventListener("click", function () {
            // Mostrar modal de inicio de sesión
            const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
            loginModal.show();
        });
    }

    // Botón para clientes no autenticados
    if (loginPromptButton2) {
        loginPromptButton2.addEventListener("click", function () {
            // Mostrar modal de inicio de sesión
            const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
            loginModal.show();
        });
    }

    // Botón para clientes autenticados
    if (cartButton) {
        cartButton.addEventListener("click", function () {
            // Mostrar el carrito (puedes agregar aquí la lógica para desplegar el mini carrito)
        });

        // Función para actualizar los contadores del carrito
        const updateCartCount = () => {
            fetch("controller/controller.carrito.php?op=get_cart_count")
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualizar ambos contadores
                        const cartCounts = document.querySelectorAll("[data-cart-count]");
                        cartCounts.forEach(countElement => {
                            countElement.textContent = data.count;
                        });
                    }
                })
                .catch(error => console.error("Error al obtener el conteo del carrito:", error));
        };

        // Llamar a la función para actualizar los contadores
        updateCartCount();
    }
});

