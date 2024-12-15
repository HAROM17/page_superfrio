document.addEventListener("DOMContentLoaded", function () {
    const loginPromptFavorites1 = document.getElementById("loginPromptFavorites1");
    const loginPromptFavorites2 = document.getElementById("loginPromptFavorites2");
    const favoritesButton = document.getElementById("favoritesButton");
    
    // Botón para clientes no autenticados
    if (loginPromptFavorites1) {
        loginPromptFavorites1.addEventListener("click", function () {
            // Mostrar modal de inicio de sesión
            const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
            loginModal.show();
        });
    }

    if (loginPromptFavorites2) {
        loginPromptFavorites2.addEventListener("click", function () {
            // Mostrar modal de inicio de sesión
            const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
            loginModal.show();
        });
    }

    // Botón para clientes autenticados
    if (favoritesButton) {
        // Redirigir a la página de favoritos
        favoritesButton.addEventListener("click", function (event) {
            event.preventDefault();
            window.location.href = "wishlist.html";
        });
        // Llamar para actualizar al cargar
        updateWishlistCount();
    }
});


// Función para actualizar el contador de favoritos
function updateWishlistCount() {
    fetch("../../controller/controller.favoritos.php?op=get_favorites_count")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const wishlistCountElements = document.querySelectorAll("[data-wishlist-count]");
                wishlistCountElements.forEach(element => {
                    element.textContent = data.count;
                });
            }
        })
        .catch(error => console.error("Error al actualizar el contador de favoritos:", error));
}

document.addEventListener("DOMContentLoaded", function () {
    const cartModal = document.querySelector(".cartmini__area");
    const cartTableBody = document.querySelector("#cart-items-container");
    // Función para cargar productos del carrito

    function loadCartItems() {
        fetch("../../controller/controller.carrito.php?op=get_cart_items")
            .then(response => response.json())
            .then(data => {
                const rutaBase = data.ruta_base; // Verifica si esto se está llenando correctamente.
                const cartWidget = document.querySelector(".cartmini__widget");
                const cartEmpty = document.querySelector(".cartmini__empty");
                const cartSubtotal = document.querySelector(".cartmini__checkout-title span");

                // Limpiar contenido previo
                cartWidget.innerHTML = "";
                let subtotal = 0;

                if (data.success && data.items.length > 0) {
                    cartEmpty.classList.add("d-none"); // Ocultar mensaje de carrito vacío
                    data.items.forEach(item => {
                        subtotal += item.prod_precio * item.cantidad;
                        const cartItemHTML = `
                            <div class="cartmini__widget-item">
                                <div class="cartmini__thumb">
                                    <a >
                                        <img src="${rutaBase}assets/imagenes/productos/${item.prod_img}" alt="${item.prod_nom}">
                                    </a>
                                </div>
                                <div class="cartmini__content">
                                    <h5 class="cartmini__title">
                                        <a >${item.subcategory_name}</a>
                                    </h5>
                                    <h6 class="cartmini__title">
                                        <a >${item.flavor_name}</a>
                                    </h6>
                                    <div class="cartmini__price-wrapper">
                                        <span class="cartmini__price">S/. ${item.prod_precio}</span>
                                        <span class="cartmini__quantity">x${item.cantidad}</span>
                                    </div>
                                </div>
                                <a class="cartmini__del" data-cart-id="${item.carrito_id}">
                                    <i class="fa-regular fa-xmark"></i>
                                </a>
                            </div>`;
                        cartWidget.insertAdjacentHTML("beforeend", cartItemHTML);
                    });
                    cartSubtotal.textContent = `S/ ${subtotal.toFixed(2)}`;
                     // Mostrar subtotal
                } else {
                    cartWidget.innerHTML = "";
                    cartEmpty.classList.remove("d-none"); // Mostrar mensaje de carrito vacío
                }
            })
            .catch(error => console.error("Error al cargar el carrito:", error));
    }

    // Abrir el modal y cargar productos
    const cartOpenButtons = document.querySelectorAll(".cartmini-open-btn");
    cartOpenButtons.forEach(button => {
        button.addEventListener("click", function () {
            loadCartItems();
        });
    });


    // Eliminar productos del carrito
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".cartmini__del")) {
            const cartId = event.target.closest(".cartmini__del").dataset.cartId;
    
            fetch("../../controller/controller.carrito.php?op=remove_from_cart", {
                method: "POST",
                body: new URLSearchParams({ carrito_id: cartId }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Producto eliminado del carrito.");
                    loadCartItems(); // Recargar el carrito
                    updateCartCount();
                    loadCartTable();
                } else {
                    console.error("Error al eliminar producto:", data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        }
    });
    
    // Función para actualizar el contador del carrito
    function updateCartCount() {
        fetch("../../controller/controller.carrito.php?op=get_cart_count")
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartCountElements = document.querySelectorAll("[data-cart-count]");
                    cartCountElements.forEach(element => {
                        element.textContent = data.count; // Actualizar el contador
                    });
                }
            })
            .catch(error => {
                console.error("Error al actualizar el contador del carrito:", error);
            });
    }
});



// Referencia al input y al contenedor de vista previa
const imageUploadInput = document.getElementById('image-upload');
const previewContainer = document.getElementById('preview');

// Escuchar el evento "change" cuando el usuario selecciona un archivo
imageUploadInput.addEventListener('change', function(event) {
    const file = event.target.files[0]; // Obtener el archivo seleccionado
    if (file) {
        const reader = new FileReader();

        // Cuando se lea el archivo, mostrar la imagen
        reader.onload = function(e) {
            previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview Image" style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">`;
        };

        reader.readAsDataURL(file); // Leer el archivo como una URL base64
    } else {
        previewContainer.innerHTML = ''; // Limpiar el contenedor si no hay archivo
    }
});



document.querySelector(".tp-checkout-btn").addEventListener("click", function (e) {
    e.preventDefault();

    const formData = new FormData();
    // Verificar y agregar el carrito al FormData
    if (Array.isArray(carritoItems) && carritoItems.length > 0) {
        formData.append("carrito", JSON.stringify(carritoItems));
        const totalProductos = carritoItems.reduce((total, item) => total + item.cantidad, 0);

        if (totalProductos < 80) {
            alert("Debe agregar al menos 80 productos al carrito para proceder con la compra.");
            return;
        }
    } else {
        alert("El carrito está vacío.");
        return;
    }

    // Obtener datos del cliente
    const nombres = document.getElementById("nombres").value.trim();
    const apellidos = document.getElementById("apellidos").value.trim();
    const dni = document.getElementById("dni").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const direccion = document.getElementById("direccion").value.trim();

    // Validar datos
    if (!nombres || !apellidos || dni.length !== 8 || isNaN(dni) || telefono.length < 9 || isNaN(telefono) || !direccion) {
        alert("Por favor, complete todos los campos correctamente.");
        return;
    }

    formData.append("nombres", nombres);
    formData.append("apellidos", apellidos);
    formData.append("dni", dni);
    formData.append("telefono", telefono);
    formData.append("direccion", direccion);



    // Obtener el método de pago seleccionado
    const metodoPagoSeleccionado = document.querySelector('input[name="payment"]:checked');
    if (!metodoPagoSeleccionado) {
        alert("Por favor, seleccione un método de pago.");
        return;
    }

    const metodoPagoId = metodoPagoSeleccionado.value; // ID del método de pago

    // Crear el FormData


    if (metodoPagoId === "2") { // Yape seleccionado
        const imageInput = document.getElementById("image-upload");

        // Validar si hay un archivo seleccionado (voucher)
        if (imageInput.files.length > 0) {
            formData.append("voucher", imageInput.files[0]); // Agregar el archivo seleccionado
        } else {
            alert("Por favor, adjunte el comprobante de pago antes de realizar el pedido.");
            return; // Detener el flujo si no hay archivo cargado
        }
    } else if (metodoPagoId === "3") { // Tarjeta seleccionada
        // Simular datos de la tarjeta
        const numeroTarjeta = document.getElementById("numero-tarjeta").value.trim();
        const fechaExpiracion = document.getElementById("fecha-expiracion").value.trim();
        const cvv = document.getElementById("cvv").value.trim();

        // Validar datos de la tarjeta
        if (!numeroTarjeta || !fechaExpiracion || !cvv) {
            alert("Por favor, complete los datos de su tarjeta para procesar el pago.");
            return;
        }

        // Adjuntar los datos de la tarjeta al FormData
        formData.append("numero_tarjeta", numeroTarjeta);
        formData.append("fecha_expiracion", fechaExpiracion);
        formData.append("cvv", cvv);
    } else {
        alert("Método de pago no válido.");
        return;
    }

    // Agregar otros datos al FormData
    formData.append("cli_id", cli_id); // ID del cliente
    formData.append("pag_id", metodoPagoId); // ID del método de pago
    formData.append("emp_id", emp_id); // ID de la empresa



    if (!confirm("¿Está seguro de que desea realizar el pedido?")) {
        return;
    }

    // Enviar la solicitud al backend
    fetch("../../controller/controller.pedido.php?op=crear_pedido", {
        method: "POST",
        body: formData, // Enviamos el FormData directamente
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                alert("Pedido realizado con éxito.");
                window.location.href = "gracias.php";
            } else {
                alert("Error al realizar el pedido: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Hubo un problema al procesar su pedido. Intente nuevamente más tarde.");
        });
});


document.querySelectorAll('input[name="payment"]').forEach((radio) => {
    radio.addEventListener("change", function () {
        const tarjetaDetalles = document.getElementById("tarjeta-detalles2");

        if (this.value === "3") { // Si se selecciona "Tarjeta"
            tarjetaDetalles.style.display = "block";
        } else { // Cualquier otro método de pago
            tarjetaDetalles.style.display = "none";
        }
    });
});



