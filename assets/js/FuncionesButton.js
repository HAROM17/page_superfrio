


// Button para redirigir al momento de precionar en comprar
document.addEventListener("DOMContentLoaded", function () {
    // Detectar clic en el botón "Comprar Ahora"
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".tp-product-details-buy-now-btn")) {
            const isAuthenticated = document.body.dataset.isAuthenticated === "true"; // Verificar autenticación
            const baseUrl = document.body.dataset.baseUrl; // Verificar autenticación

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
            window.location.href = `${baseUrl}view/finalizar-compra/`;
        }
    });
});

/* ############################################ */

// Listar carrito en el modal
document.addEventListener("DOMContentLoaded", function () {
    const baseUrl = document.body.dataset.baseUrl;

    // Botones para clientes no autenticados
    const loginPrompts = [
        document.getElementById("loginPromptButton1"),
        document.getElementById("loginPromptButton2")
    ];

    loginPrompts.forEach(button => {
        if (button) {
            button.addEventListener("click", function () {
                // Mostrar modal de inicio de sesión
                const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
                loginModal.show();
            });
        }
    });

    // Botones para clientes autenticados
    const cartButtons = [
        document.getElementById("cartButton"),
        document.getElementById("cartButtonFloating"),
        document.getElementById("cartButtonMovil") // Puedes agregar más botones si es necesario
    ];

    cartButtons.forEach(button => {
        if (button) {
            button.addEventListener("click", function () {
                // Lógica para mostrar el carrito
                console.log("Carrito desplegado"); // Reemplaza con tu lógica para mostrar el mini carrito
            });
        }
    });

    // Función para actualizar los contadores del carrito
    const updateCartCount = () => {
        fetch(`${baseUrl}controller/controller.carrito.php?op=get_cart_count`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar todos los contadores en los botones
                    const cartCounts = document.querySelectorAll("[data-cart-count]");
                    cartCounts.forEach(countElement => {
                        countElement.textContent = data.count;
                    });
                }
            })
            .catch(error => console.error("Error al obtener el conteo del carrito:", error));
    };

    if (cartButtons.some(button => button)) {
        updateCartCount();
    }
});

// Función para actualizar el contador del carrito
function updateCartCount() {
    const baseUrl = document.body.dataset.baseUrl;
    fetch(`${baseUrl}controller/controller.carrito.php?op=get_cart_count`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartCountElements = document.querySelectorAll("[data-cart-count]");
                cartCountElements.forEach(element => {
                    element.textContent = data.count; // Actualizar el contador
                });
            }
        })
        .catch(error => console.error("Error al actualizar el contador del carrito:", error));
}



/* ############################################ */
// Carga los favoritos
document.addEventListener("DOMContentLoaded", function () {
    const baseUrl = document.body.dataset.baseUrl;

    // Botones de "Favoritos" no autenticados
    const loginPrompts = [
        document.getElementById("loginPromptFavorites1"),
        document.getElementById("loginPromptFavorites2"),
        document.getElementById("loginPromptFavorites3")
    ];

    loginPrompts.forEach(button => {
        if (button) {
            button.addEventListener("click", function () {
                // Mostrar modal de inicio de sesión
                const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
                loginModal.show();
            });
        }
    });

    // Botones de "Favoritos" autenticados
    const favoritesButtons = [
        document.getElementById("favoritesButton"),
        document.getElementById("favoritesButtonFloating"),
        document.getElementById("favoritesButtonMovil") 
    ];

    favoritesButtons.forEach(button => {
        if (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();
                // Redirigir a la página de favoritos
                window.location.href = `${baseUrl}view/favoritos/`;
            });
        }
    });

    // Llamar a la función de actualización de favoritos solo una vez
    if (favoritesButtons.some(button => button)) {
        updateWishlistCount();
    }
});

// Funcion para los botones de agregar y eliminar favoritos
function handleWishlistButtons() {
    const isAuthenticated = document.body.dataset.isAuthenticated === "true"; // Verificar autenticación (puede venir del backend como atributo de `<body>`)
    const wishlistButtons = document.querySelectorAll('.tp-product-add-to-wishlist-btn');

    wishlistButtons.forEach(button => {
        button.addEventListener('click', function () {
            const prodId = this.dataset.prodId; // Obtener el ID del producto

            if (!isAuthenticated) {
                // Mostrar el modal de inicio de sesión
                const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
                loginModal.show();
                return;
            }

            if (this.classList.contains('is-favorite')) {
                // Si ya está en favoritos, eliminarlo
                removeFromWishlist(prodId, this);
            } else {
                // Si no está en favoritos, agregarlo
                addToWishlist(prodId, this);
            }
        });
    });
}
//Función para eliminar de favoritos:
function removeFromWishlist(prodId, button) {
    const baseUrl = document.body.dataset.baseUrl;
    fetch(`${baseUrl}controller/controller.favoritos.php?op=eliminar_favoritos`, {
        method: "POST",
        body: new URLSearchParams({ prod_id: prodId }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.classList.remove('is-favorite'); // Quitar la marca de favorito
                button.innerHTML = `
                    <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.78158 8.88867C3.15121 13.1386 8.5623 16.5749 10.0003 17.4255C11.4432 16.5662 16.8934 13.0918 18.219 8.89257C19.0894 6.17816 18.2815 2.73984 15.0714 1.70806C13.5162 1.21019 11.7021 1.5132 10.4497 2.4797C10.1879 2.68041 9.82446 2.68431 9.56069 2.48555C8.23405 1.49079 6.50102 1.19947 4.92136 1.70806C1.71613 2.73887 0.911158 6.17718 1.78158 8.88867ZM10.0013 19C9.88015 19 9.75999 18.9708 9.65058 18.9113C9.34481 18.7447 2.14207 14.7852 0.386569 9.33491C0.385592 9.33491 0.385592 9.33394 0.385592 9.33394C-0.71636 5.90244 0.510636 1.59018 4.47199 0.316764C6.33203 -0.283407 8.35911 -0.019371 9.99836 1.01242C11.5868 0.0108324 13.6969 -0.26587 15.5198 0.316764C19.4851 1.59213 20.716 5.90342 19.615 9.33394C17.9162 14.7218 10.6607 18.7408 10.353 18.9094C10.2436 18.9698 10.1224 19 10.0013 19Z" fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.7806 7.42904C15.4025 7.42904 15.0821 7.13968 15.0508 6.75775C14.9864 5.95687 14.4491 5.2807 13.6841 5.03421C13.2983 4.9095 13.0873 4.49737 13.2113 4.11446C13.3373 3.73059 13.7467 3.52209 14.1335 3.6429C15.4651 4.07257 16.398 5.24855 16.5123 6.63888C16.5445 7.04127 16.2446 7.39397 15.8412 7.42612C15.8206 7.42807 15.8011 7.42904 15.7806 7.42904Z" fill="currentColor"></path>
                    </svg>
                    <span class="tp-product-tooltip">Añadir a Favoritos</span>
                `; // Restaurar SVG original
                console.log("Producto eliminado de favoritos");
                updateWishlistCount();
            } else {
                console.error(data.message || "Hubo un problema al eliminar el producto de favoritos.");
            }
        })
        .catch(error => {
            console.error("Error al eliminar el producto de favoritos:", error);
        });
}
// Función para agregar a favoritos
function addToWishlist(prodId, button) {
    const baseUrl = document.body.dataset.baseUrl;
    fetch(`${baseUrl}controller/controller.favoritos.php?op=agregar_favoritos`, {
        method: "POST",
        body: new URLSearchParams({ prod_id: prodId }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.classList.add('is-favorite'); // Marcar como favorito
                button.innerHTML = '❤️'; // Cambiar ícono visual
                console.log("Producto agregado a favoritos");
                updateWishlistCount();
            } else {
                console.error(data.message || "Hubo un problema al agregar el producto a favoritos.");
            }
        })
        .catch(error => {
            console.error("Error al agregar el producto a favoritos:", error);
        });
}

// Función para actualizar el contador de favoritos
function updateWishlistCount() {
    const baseUrl = document.body.dataset.baseUrl;
    fetch(`${baseUrl}controller/controller.favoritos.php?op=get_favorites_count`)
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


/* ############################################ */
// Funcion para mostrar login e diregir perfil
document.addEventListener("DOMContentLoaded", function () {
    const isAuthenticated = document.body.dataset.isAuthenticated === "true";
    const accountLinkM = document.getElementById("accountLinkMovil");
    const accountLink = document.getElementById("accountLink");

    if (accountLinkM) {
        accountLinkM.addEventListener("click", function (event) {
            event.preventDefault();
            const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
            loginModal.show();
        });
    }

    if (accountLink) {
        accountLink.addEventListener("click", function (event) {
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


/* ############################################ */


// Funion para agregar un producto al carrito
document.addEventListener("DOMContentLoaded", function () {
    // Detectar clic en los botones "Agregar al Carrito"
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".tp-product-add-cart-btn")) {
            const button = event.target.closest(".tp-product-add-cart-btn");
            const prodId = button.getAttribute("data-prod-id"); // Obtener el ID del producto

            // Validar que el ID del producto exista
            if (!prodId) {
                console.error("ID del producto no válido.");
                return;
            }

            // Comprobar autenticación
            const isAuthenticated = document.body.dataset.isAuthenticated === "true";
            if (!isAuthenticated) {
                // Mostrar modal de inicio de sesión
                const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
                loginModal.show();
                return;
            }

            // Llamar a la función para agregar un producto al carrito
            addSingleProductToCart(prodId);
        }
    });

    // Función para agregar un producto al carrito con cantidad fija de 1
    function addSingleProductToCart(prodId) {
        const baseUrl = document.body.dataset.baseUrl;
        fetch(`${baseUrl}controller/controller.carrito.php?op=add_to_cart`, {
            method: "POST",
            body: new URLSearchParams({
                prod_id: prodId,
                cantidad: 1
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Producto agregado al carrito:", data.message);
                    Swal.fire({
                        icon: "success",
                        title: "Producto agregado al carrito",
                        timer: 2000, // Cierra automáticamente después de 2 segundos
                        showConfirmButton: false
                    });
                    updateCartCount(); // Actualizar el contador del carrito
                } else {
                    console.error("Error al agregar el producto:", data.message);
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error al agregar el producto al carrito:", error));
    }
});


// eliminar y listar productos en el modal
document.addEventListener("DOMContentLoaded", function () {
    // Función para cargar productos del carrito
    function loadCartItems() {
        const baseUrl = document.body.dataset.baseUrl;
        fetch(`${baseUrl}controller/controller.carrito.php?op=get_cart_items`)
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
                    cartSubtotal.textContent = `S/ ${subtotal.toFixed(2)}`; // Mostrar subtotal
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
            const baseUrl = document.body.dataset.baseUrl;
            fetch(`${baseUrl}controller/controller.carrito.php?op=remove_from_cart`, {
                method: "POST",
                body: new URLSearchParams({ carrito_id: cartId }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Producto",
                        text: "Eliminado del carrito",
                        timer: 2000, // Cierra automáticamente después de 2 segundos
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal2-custom-popup' // Clase personalizada
                        }
                    });
                    loadCartItems(); 
                    updateCartCount();
                    window.loadCartTable();
                } else {
                    console.error("Error al eliminar producto:", data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        }
    });
    // Ajuste del z-index directamente en JavaScript
    const swalStyle = document.createElement("style");
    swalStyle.innerHTML = `
        .swal2-container {
            z-index: 9999 !important; /* Asegura que esté al frente */
        }
    `;
    document.head.appendChild(swalStyle);
});


// MOSTRAR DETALLE Y AGREGAR CARRITO
document.addEventListener("DOMContentLoaded", function () {
    // Detectar clic en el botón "Ver Más"
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".tp-product-quick-view-btn")) {
            const button = event.target.closest(".tp-product-quick-view-btn");
            const prodId = button.getAttribute("data-prod-id"); // Obtener el ID del producto

            // Cargar los detalles del producto
            fetchProductDetails(prodId);
        }
    });

    // Detectar clic en el botón "Agregar al Carrito"
    document.body.addEventListener("click", function (event) {
        if (event.target.closest(".tp-product-details-add-to-cart-btn")) {
            const cantidadInput = document.querySelector("#producQuickViewModal .tp-cart-input");
            const cantidad = parseInt(cantidadInput ? cantidadInput.value : 1);
            const prodId = document.querySelector("#producQuickViewModal").getAttribute("data-prod-id");

            // Validar parámetros
            if (!prodId || isNaN(cantidad) || cantidad <= 0) {
                console.error("Faltan parámetros o cantidad inválida.");
                return;
            }

            // Llamar a la función para agregar al carrito
            addToCart(prodId, cantidad);
            cantidadInput.value = 1;

        }
    });

    // Función para cargar los detalles del producto
    function fetchProductDetails(prodId) {
        const baseUrl = document.body.dataset.baseUrl;
        fetch(`${baseUrl}controller/controller.producto.php?op=get_product_details`, {
            method: "POST",
            body: new URLSearchParams({
                prod_id: prodId,
                emp_id: 1 // Ajusta este ID según tu empresa
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar los detalles del producto en el modal
                    updateProductDetails(data.product, data.ruta_base);
                } else {
                    console.error("No se encontraron detalles para este producto.");
                }
            })
            .catch(error => {
                console.error("Error al cargar los detalles del producto:", error);
            });
    }

    // Función para actualizar los detalles del producto en el modal
    function updateProductDetails(product, rutaBase) {
        const modalElement = document.getElementById('producQuickViewModal');
        modalElement.setAttribute('data-prod-id', product.prod_id); // Guardar el ID del producto en el modal

        // Actualizar la imagen principal
        const imageElement = document.querySelector('#producQuickViewModal .tp-product-details-nav-main-thumb img');
        imageElement.src = `${rutaBase}assets/imagenes/productos/${product.prod_img}`;
        imageElement.alt = product.prod_nom;

        // Actualizar otros detalles
        document.querySelector('#productDescription').textContent = product.prod_descrip || "No hay descripción disponible.";
        document.querySelector('#categoria').textContent = product.category || "No hay Categoría disponible.";
        document.querySelector('#subcatnom').textContent = product.sub_brand || "No hay Subcategoría disponible.";
        document.querySelector('#sabor').textContent = product.flavor || "No hay Sabor disponible.";
        document.querySelector('#precio').textContent = `S/ ${product.prod_precio || "No hay Precio disponible."}`;

        // Mostrar el modal (Bootstrap)
        const modal = new bootstrap.Modal(modalElement);
        modal.show();

        // Asegurarse de que el scroll sea restaurado tras cerrar el modal
        modalElement.addEventListener('hidden.bs.modal', function () {
            const modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
            document.body.style.overflow = 'auto'; // Restaurar el scroll
        });
    }

    // Función para agregar al carrito
    function addToCart(prodId, cantidad) {
        const isAuthenticated = document.body.dataset.isAuthenticated === "true";
    
        if (!isAuthenticated) {
            // Mostrar el modal de inicio de sesión en primer plano
            const authModalElement = document.getElementById("authModal");
            const loginModal = new bootstrap.Modal(authModalElement);
            loginModal.show();
    
            // Ajustar el z-index del modal y su fondo
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.style.zIndex = 1059; // Asegurar que el fondo oscuro esté detrás
            }
    
            // Restaurar estados cuando se cierre el modal de inicio de sesión
            authModalElement.addEventListener("hidden.bs.modal", function () {
                const productModal = bootstrap.Modal.getInstance(document.getElementById("producQuickViewModal"));
    
                // Si el modal de producto sigue abierto, reactivar su backdrop
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
                    document.body.style.overflow = "auto"; // Restaurar el scroll
                }
            });
    
            return; // Salir de la función si no está autenticado
        }
    
        // Si está autenticado, proceder con la lógica de agregar al carrito
        const baseUrl = document.body.dataset.baseUrl;
        fetch(`${baseUrl}controller/controller.carrito.php?op=add_to_cart`, {
            method: "POST",
            body: new URLSearchParams({
                prod_id: prodId,
                cantidad: cantidad
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message); // Mensaje de éxito
                    Swal.fire({
                        icon: "success",
                        title: "Productos agregado al carrito",
                        timer: 2000, // Cierra automáticamente después de 2 segundos
                        showConfirmButton: false
                    });
                    updateCartCount(); // Actualizar el contador del carrito
                } else {
                    console.error(data.message); // Mensaje de error
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error al agregar el producto al carrito:", error);
            });
    }
});




