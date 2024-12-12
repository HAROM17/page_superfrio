

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




document.addEventListener("DOMContentLoaded", function () {
    // ID de la empresa
    const EMPRESA_ID = 1; // Ajusta esto según la empresa actual
    const newTabButton = document.getElementById("new-tab");
    // Llamar a la función para obtener productos nuevos
    fetchNewProducts();

    // Función para obtener los productos nuevos
    function fetchNewProducts() {
        fetch("../../controller/controller.producto.php?op=l_all_productos", {
            method: "POST",
            body: new URLSearchParams({ emp_id: EMPRESA_ID }), // Enviar el ID de la empresa
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data && data.products && data.products.length > 0) {
                    renderNewProducts(data.products, data.ruta_base);
                    newTabButton.style.display = "inline-block"; // Asegurar que se muestre si hay productos
                } else {
                    console.error("No se encontraron productos nuevos.");
                    newTabButton.style.display = "none"; // Ocultar si no hay productos
                }
            })
            .catch(error => {
                console.error("Error al listar productos nuevos:", error);
                newTabButton.style.display = "none"; // Ocultar en caso de error
            });
    }

    // Función para renderizar los productos nuevos en el DOM
    function renderNewProducts(products, rutaBase) {
        const container = document.getElementById("new-products-container");
        container.innerHTML = ""; // Limpiar contenido previo

        // Array de clases para los badges
        const badgeClasses = ["product-offer", "product-hot", "product-sale", "product-trending"];

        products.forEach(product => {
            // Seleccionar una clase aleatoria del array
            const randomBadgeClass = badgeClasses[Math.floor(Math.random() * badgeClasses.length)];
            const favoriteClass = product.is_favorited === 1 ? 'is-favorite' : '';
            const isFavoriteIcon = product.is_favorited === 1
            ? '❤️' // Icono de corazón rojo si ya está en favoritos
            : `<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path fill-rule="evenodd" clip-rule="evenodd" d="M1.78158 8.88867C3.15121 13.1386 8.5623 16.5749 10.0003 17.4255C11.4432 16.5662 16.8934 13.0918 18.219 8.89257C19.0894 6.17816 18.2815 2.73984 15.0714 1.70806C13.5162 1.21019 11.7021 1.5132 10.4497 2.4797C10.1879 2.68041 9.82446 2.68431 9.56069 2.48555C8.23405 1.49079 6.50102 1.19947 4.92136 1.70806C1.71613 2.73887 0.911158 6.17718 1.78158 8.88867ZM10.0013 19C9.88015 19 9.75999 18.9708 9.65058 18.9113C9.34481 18.7447 2.14207 14.7852 0.386569 9.33491C0.385592 9.33491 0.385592 9.33394 0.385592 9.33394C-0.71636 5.90244 0.510636 1.59018 4.47199 0.316764C6.33203 -0.283407 8.35911 -0.019371 9.99836 1.01242C11.5868 0.0108324 13.6969 -0.26587 15.5198 0.316764C19.4851 1.59213 20.716 5.90342 19.615 9.33394C17.9162 14.7218 10.6607 18.7408 10.353 18.9094C10.2436 18.9698 10.1224 19 10.0013 19Z" fill="currentColor"></path>
                   <path fill-rule="evenodd" clip-rule="evenodd" d="M15.7806 7.42904C15.4025 7.42904 15.0821 7.13968 15.0508 6.75775C14.9864 5.95687 14.4491 5.2807 13.6841 5.03421C13.2983 4.9095 13.0873 4.49737 13.2113 4.11446C13.3373 3.73059 13.7467 3.52209 14.1335 3.6429C15.4651 4.07257 16.398 5.24855 16.5123 6.63888C16.5445 7.04127 16.2446 7.39397 15.8412 7.42612C15.8206 7.42807 15.8011 7.42904 15.7806 7.42904Z" fill="currentColor"></path>
               </svg>`;
            const productHTML = `
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="tp-product-item p-relative transition-3 mb-25">
                        <div class="tp-product-thumb p-relative fix m-img">
                            <a>
                                <img src="${rutaBase}assets/imagenes/productos/${product.prod_img}" alt="${product.prod_nom}">
                            </a>
                            <div class="tp-product-badge">
                                <span class="${randomBadgeClass}">Shop</span>
                            </div>
                            <div class="tp-product-action">
                                <div class="tp-product-action-item d-flex flex-column">
                                    <button type="button" class="tp-product-action-btn tp-product-add-cart-btn" data-prod-id="${product.prod_id}">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93795 5.34749L4.54095 12.5195C4.58495 13.0715 5.03594 13.4855 5.58695 13.4855H5.59095H16.5019H16.5039C17.0249 13.4855 17.4699 13.0975 17.5439 12.5825L18.4939 6.02349C18.5159 5.86749 18.4769 5.71149 18.3819 5.58549C18.2879 5.45849 18.1499 5.37649 17.9939 5.35449C17.7849 5.36249 9.11195 5.35049 3.93795 5.34749ZM5.58495 14.9855C4.26795 14.9855 3.15295 13.9575 3.04595 12.6425L2.12995 1.74849L0.622945 1.48849C0.213945 1.41649 -0.0590549 1.02949 0.0109451 0.620487C0.082945 0.211487 0.477945 -0.054513 0.877945 0.00948704L2.95795 0.369487C3.29295 0.428487 3.54795 0.706487 3.57695 1.04649L3.81194 3.84749C18.0879 3.85349 18.1339 3.86049 18.2029 3.86849C18.7599 3.94949 19.2499 4.24049 19.5839 4.68849C19.9179 5.13549 20.0579 5.68649 19.9779 6.23849L19.0289 12.7965C18.8499 14.0445 17.7659 14.9855 16.5059 14.9855H16.5009H5.59295H5.58495Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8979 9.04382H12.1259C11.7109 9.04382 11.3759 8.70782 11.3759 8.29382C11.3759 7.87982 11.7109 7.54382 12.1259 7.54382H14.8979C15.3119 7.54382 15.6479 7.87982 15.6479 8.29382C15.6479 8.70782 15.3119 9.04382 14.8979 9.04382Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.15474 17.702C5.45574 17.702 5.69874 17.945 5.69874 18.246C5.69874 18.547 5.45574 18.791 5.15474 18.791C4.85274 18.791 4.60974 18.547 4.60974 18.246C4.60974 17.945 4.85274 17.702 5.15474 17.702Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.15374 18.0409C5.04074 18.0409 4.94874 18.1329 4.94874 18.2459C4.94874 18.4729 5.35974 18.4729 5.35974 18.2459C5.35974 18.1329 5.26674 18.0409 5.15374 18.0409ZM5.15374 19.5409C4.43974 19.5409 3.85974 18.9599 3.85974 18.2459C3.85974 17.5319 4.43974 16.9519 5.15374 16.9519C5.86774 16.9519 6.44874 17.5319 6.44874 18.2459C6.44874 18.9599 5.86774 19.5409 5.15374 19.5409Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.435 17.702C16.736 17.702 16.98 17.945 16.98 18.246C16.98 18.547 16.736 18.791 16.435 18.791C16.133 18.791 15.89 18.547 15.89 18.246C15.89 17.945 16.133 17.702 16.435 17.702Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"  d="M16.434 18.0409C16.322 18.0409 16.23 18.1329 16.23 18.2459C16.231 18.4749 16.641 18.4729 16.64 18.2459C16.64 18.1329 16.547 18.0409 16.434 18.0409ZM16.434 19.5409C15.72 19.5409 15.14 18.9599 15.14 18.2459C15.14 17.5319 15.72 16.9519 16.434 16.9519C17.149 16.9519 17.73 17.5319 17.73 18.2459C17.73 18.9599 17.149 19.5409 16.434 19.5409Z" fill="currentColor"></path>
                                        </svg>

                                        <span class="tp-product-tooltip">Agregar Carrito</span>
                                    </button>
                                
                                    <button type="button" class="tp-product-action-btn tp-product-quick-view-btn" data-prod-id="${product.prod_id}"  data-bs-toggle="modal" data-bs-target="#producQuickViewModal" >
                                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99938 5.64111C8.66938 5.64111 7.58838 6.72311 7.58838 8.05311C7.58838 9.38211 8.66938 10.4631 9.99938 10.4631C11.3294 10.4631 12.4114 9.38211 12.4114 8.05311C12.4114 6.72311 11.3294 5.64111 9.99938 5.64111ZM9.99938 11.9631C7.84238 11.9631 6.08838 10.2091 6.08838 8.05311C6.08838 5.89611 7.84238 4.14111 9.99938 4.14111C12.1564 4.14111 13.9114 5.89611 13.9114 8.05311C13.9114 10.2091 12.1564 11.9631 9.99938 11.9631Z" fill="currentColor"></path>

                                            <g mask="url(#mask0_1211_721)">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.56975 8.05226C3.42975 12.1613 6.56275 14.6043 9.99975 14.6053C13.4368 14.6043 16.5697 12.1613 18.4298 8.05226C16.5697 3.94426 13.4368 1.50126 9.99975 1.50026C6.56375 1.50126 3.42975 3.94426 1.56975 8.05226ZM10.0017 16.1053H9.99775H9.99675C5.86075 16.1023 2.14675 13.2033 0.06075 8.34826C-0.02025 8.15926 -0.02025 7.94526 0.06075 7.75626C2.14675 2.90226 5.86175 0.00326172 9.99675 0.000261719C9.99875 -0.000738281 9.99875 -0.000738281 9.99975 0.000261719C10.0017 -0.000738281 10.0017 -0.000738281 10.0028 0.000261719C14.1388 0.00326172 17.8527 2.90226 19.9387 7.75626C20.0208 7.94526 20.0208 8.15926 19.9387 8.34826C17.8537 13.2033 14.1388 16.1023 10.0028 16.1053H10.0017Z" fill="currentColor"></path>
                                            </g>
                                        </svg>
                                        <span class="tp-product-tooltip">Ver Producto</span>
                                    </button>

                                    <button type="button" class="tp-product-action-btn tp-product-add-to-wishlist-btn ${favoriteClass}"   data-prod-id="${product.prod_id}">
                                        ${isFavoriteIcon}
                                        <span class="tp-product-tooltip">Añadir a Favoritos</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tp-product-content">
                            <div class="tp-product-category">
                                <a href="shop.html">${product.sub_marca}</a>
                            </div>
                            <h3 class="tp-product-title">
                                <a href="product-details.html">${product.sabor}</a>
                            </h3>
                            <div class="tp-product-rating d-flex align-items-center">
                                <div class="tp-product-rating-icon">
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star-half-stroke"></i></span>
                                </div>
                                <div class="tp-product-rating-text">
                                    <span>(700 Review)</span>
                                </div>
                            </div>
                            <div class="tp-product-price-wrapper">
                                <span class="tp-product-price new-price">S/ ${product.prod_precio}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML("beforeend", productHTML);
        });
        handleWishlistButtons();
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

// funcion de los botones de agregar y eliminar favoritos
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

// Función para agregar a favoritos
function addToWishlist(prodId, button) {
    fetch("../../controller/controller.favoritos.php?op=agregar_favoritos", {
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

//Función para eliminar de favoritos:
function removeFromWishlist(prodId, button) {
    fetch("../../controller/controller.favoritos.php?op=eliminar_favoritos", {
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
        
        fetch("../../controller/controller.producto.php?op=get_product_details", {
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
        fetch("../../controller/controller.carrito.php?op=add_to_cart", {
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
                    alert("Producto agregado al carrito correctamente.");
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
                    updateCartCount(); // Actualizar el contador
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
        fetch("../../controller/controller.carrito.php?op=add_to_cart", {
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
                    alert("Producto agregado al carrito correctamente.");
                    updateCartCount(); // Actualizar el contador del carrito
                } else {
                    console.error("Error al agregar el producto:", data.message);
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error al agregar el producto al carrito:", error));
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
            .catch(error => console.error("Error al actualizar el contador del carrito:", error));
    }
});



