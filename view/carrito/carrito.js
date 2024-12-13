

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

// BOTON DE COMPRAR 
document.addEventListener("DOMContentLoaded", function () {
    // Detectar clic en el botón "Comprar Ahora"
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".tp-product-details-buy-now-btn")) {
            const isAuthenticated = document.body.dataset.isAuthenticated === "true"; // Verificar autenticación

            if (!isAuthenticated) {
                // Mostrar el modal de inicio de sesión si no está autenticado
                const authModalElement = document.getElementById("authModal");
                const loginModal = new bootstrap.Modal(authModalElement);
                loginModal.show();

                // Ajustar el z-index del modal y su fondo
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.style.zIndex = 1059; // Asegurar que el fondo oscuro esté detrás
                }

                // Manejar la restauración tras cerrar el modal
                authModalElement.addEventListener("hidden.bs.modal", function () {
                    const productModal = bootstrap.Modal.getInstance(document.getElementById("producQuickViewModal"));

                    // Si el modal de producto sigue abierto, ajustar su fondo
                    if (productModal && productModal._isShown) {
                        const productBackdrop = document.querySelector('.modal-backdrop');
                        if (productBackdrop) {
                            productBackdrop.style.zIndex = ""; // Restaurar z-index original del backdrop
                        }
                        document.body.classList.add("modal-open"); // Mantener clase para evitar scroll
                    } else {
                        // Si no hay modales abiertos, elimina el backdrop y restaura el scroll
                        if (backdrop) {
                            backdrop.remove();
                        }
                    }
                });

                return; // Salir de la función si no está autenticado
            }

            // Si está autenticado, redirigir a realizarcompra.php
            window.location.href = "realizarcompra.php";
        }
    });
});


// LISTAR Y ELIMINAR PRODUCTOS EN CARRITO
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

    function loadCartTable() {
        fetch("../../controller/controller.carrito.php?op=listar_carrito", {
            method: "POST",
            body: new URLSearchParams({
                emp_id: 1 // ID de la empresa, ajusta según corresponda
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderCartTable(data.productos, data.ruta_base);
            } else {
                console.error("Error al cargar la tabla del carrito:", data.message);
            }
        })
        .catch(error => {
            console.error("Error al cargar los datos de la tabla del carrito:", error);
        });
    }

    function renderCartTable(cartItems, rutaBase) {
        cartTableBody.innerHTML = ""; // Limpiar contenido previo
    
        cartItems.forEach(item => {
            const row = `
                <tr>
                    <td class="tp-cart-img">
                        <a href="product-details.html">
                            <img src="${rutaBase}assets/imagenes/productos/${item.prod_img}" alt="${item.prod_nom}">
                        </a>
                    </td>
                    <td class="tp-cart-title">
                        <a href="product-details.html">${item.prod_nom}</a>
                        <p>Categoría: ${item.category_name || "N/A"}</p>
                        <p>Subcategoría: ${item.subcategory_name || "N/A"}</p>
                        <p>Sabor: ${item.flavor_name || "N/A"}</p>
                    </td>
                    <td class="tp-cart-price"><span>S/ ${item.prod_precio}</span></td>
                    <td class="tp-cart-quantity">
                        <div class="tp-product-quantity mt-10 mb-10">
                            <span class="tp-cart-minus">-</span>
                            <input class="tp-cart-input" type="text" value="${item.cantidad}">
                            <span class="tp-cart-plus">+</span>
                        </div>
                    </td>
                    <td class="tp-cart-action">
                        <button class="tp-cart-action-btn" data-carrito-id="${item.carrito_id}">
                            <i class="fa-regular fa-xmark"></i> Eliminar
                        </button>
                    </td>
                </tr>
            `;
            cartTableBody.insertAdjacentHTML("beforeend", row);
        });
    }
    loadCartTable();
    
});





// FUNCIONES PARA LISTAR Y ELIMINAR CARRITO EN LA TABLA
document.addEventListener("DOMContentLoaded", function () {
    const subtotalElement = document.getElementById("cart-subtotal");
    const totalElement = document.getElementById("cart-total");
    const updateCartButton = document.getElementById("update-cart-btn");
    const cartTableBody = document.querySelector("#cart-items-container");
    function calculateTotals() {
        let subtotal = 0;

        document.querySelectorAll(".tp-cart-input").forEach(input => {
            const price = parseFloat(input.dataset.price);
            const quantity = parseInt(input.value);
            subtotal += price * quantity;
        });

        subtotalElement.textContent = `S/ ${subtotal.toFixed(2)}`;
        totalElement.textContent = `S/ ${subtotal.toFixed(2)}`;
    }
    document.body.addEventListener("click", function (event) {
        const button = event.target.closest(".tp-cart-action-btn");
        if (button) {
            const carritoId = button.getAttribute("data-carrito-id");
            if (carritoId) {
                eliminarDelCarrito(carritoId); // Llama a la función de eliminación
            }
        }
    });
    
    // Función para cargar los productos en la tabla del carrito
    function loadCartTable() {
        fetch("../../controller/controller.carrito.php?op=listar_carrito", {
            method: "POST",
            body: new URLSearchParams({
                emp_id: 1 // ID de la empresa, ajusta según corresponda
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderCartTable(data.productos, data.ruta_base);
            } else {
                console.error("Error al cargar la tabla del carrito:", data.message);
            }
        })
        .catch(error => {
            console.error("Error al cargar los datos de la tabla del carrito:", error);
        });
    }

    // Renderizar productos en la tabla del carrito
    function renderCartTable(cartItems, rutaBase) {
        cartTableBody.innerHTML = ""; // Limpiar contenido previo
    
        cartItems.forEach(item => {
            const row = `
                <tr>
                    <td class="tp-cart-img">
                        <a href="product-details.html">
                            <img src="${rutaBase}assets/imagenes/productos/${item.prod_img}" alt="${item.prod_nom}">
                        </a>
                    </td>
                    <td class="tp-cart-title">
                        <a href="product-details.html">${item.prod_nom}</a>
                        <p>Categoría: ${item.category_name || "N/A"}</p>
                        <p>Subcategoría: ${item.subcategory_name || "N/A"}</p>
                        <p>Sabor: ${item.flavor_name || "N/A"}</p>
                    </td>
                    <td class="tp-cart-price"><span>S/ ${item.prod_precio}</span></td>
                    <td class="tp-cart-quantity">
                        <div class="tp-product-quantity mt-10 mb-10">
                            <span class="tp-cart-minus">-</span>
                            <input class="tp-cart-input" type="text" value="${item.cantidad}" data-cart-id="${item.carrito_id}" data-price="${item.prod_precio}">
                            <span class="tp-cart-plus">+</span>
                        </div>
                    </td>
                    <td class="tp-cart-action">
                        <button class="tp-cart-action-btn" data-carrito-id="${item.carrito_id}">
                            <i class="fa-regular fa-xmark"></i> Eliminar
                        </button>
                    </td>
                </tr>
            `;
            cartTableBody.insertAdjacentHTML("beforeend", row);
        });
        calculateTotals();
    }

    // Función para eliminar un producto y recargar la tabla
    function eliminarDelCarrito(carritoId) {
        fetch("../../controller/controller.carrito.php?op=delete_cart_item", {
            method: "POST",
            body: new URLSearchParams({ carrito_id: carritoId }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Producto eliminado del carrito.");
                loadCartTable(); // Recargar la tabla del carrito
                updateCartCount(); // Actualizar el contador del carrito
            } else {
                console.error("Error al eliminar el producto:", data.message);
                alert("No se pudo eliminar el producto del carrito.");
            }
        })
        .catch(error => console.error("Error al realizar la solicitud de eliminación:", error));
    }

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
    
    cartTableBody.addEventListener("click", function (event) {
        const target = event.target;
        const input = target.closest(".tp-product-quantity")?.querySelector(".tp-cart-input");

        if (target.classList.contains("tp-cart-plus") && input) {
            input.value = parseInt(input.value) + 1;
            calculateTotals();
        }

        if (target.classList.contains("tp-cart-minus") && input) {
            input.value = Math.max(parseInt(input.value) - 1, 1); // Evitar cantidades negativas
            calculateTotals();
        }
    });

    // Botón para actualizar el carrito
    updateCartButton.addEventListener("click", function () {
        const updatedItems = [];
    
        document.querySelectorAll(".tp-cart-input").forEach(input => {
            updatedItems.push({
                carrito_id: input.dataset.cartId, // ID del carrito
                cantidad: parseInt(input.value, 10) // Cantidad del producto
            });
        });
    
        fetch("../../controller/controller.carrito.php?op=update_cart_items", {
            method: "POST",
            body: JSON.stringify({ items: updatedItems }),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Carrito actualizado correctamente.");
                loadCartTable(); 
                updateCartCount();// Recargar tabla después de actualizar
            } else {
                alert(data.message || "Error al actualizar el carrito.");
            }
        })
        .catch(error => console.error("Error al actualizar el carrito:", error));
    });
    
    // Cargar la tabla del carrito al cargar la página
    loadCartTable();
});






