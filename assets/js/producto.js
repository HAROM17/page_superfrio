document.addEventListener("DOMContentLoaded", function () {
    // ID de la empresa
    const EMPRESA_ID = 1; // Ajusta esto según la empresa actual
    const newTabButton = document.getElementById("new-tab");
    // Llamar a la función para obtener productos nuevos
    fetchNewProducts();

    // Función para obtener los productos nuevos
    function fetchNewProducts() {
        fetch("controller/controller.producto.php?op=l_nuevos_productos", {
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

            const productHTML = `
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="tp-product-item p-relative transition-3 mb-25">
                        <div class="tp-product-thumb p-relative fix m-img">
                            <a href="product-details.html">
                                <img src="${rutaBase}assets/imagenes/productos/${product.prod_img}" alt="${product.prod_nom}">
                            </a>
                            <div class="tp-product-badge">
                                <span class="${randomBadgeClass}">Nuevo Sabor</span>
                            </div>
                            <div class="tp-product-action">
                                <div class="tp-product-action-item d-flex flex-column">
                                    <button type="button" class="tp-product-action-btn tp-product-add-cart-btn add-to-cart-btn" data-prod-id="${product.prod_id}">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93795 5.34749L4.54095 12.5195C4.58495 13.0715 5.03594 13.4855 5.58695 13.4855H5.59095H16.5019H16.5039C17.0249 13.4855 17.4699 13.0975 17.5439 12.5825L18.4939 6.02349C18.5159 5.86749 18.4769 5.71149 18.3819 5.58549C18.2879 5.45849 18.1499 5.37649 17.9939 5.35449C17.7849 5.36249 9.11195 5.35049 3.93795 5.34749ZM5.58495 14.9855C4.26795 14.9855 3.15295 13.9575 3.04595 12.6425L2.12995 1.74849L0.622945 1.48849C0.213945 1.41649 -0.0590549 1.02949 0.0109451 0.620487C0.082945 0.211487 0.477945 -0.054513 0.877945 0.00948704L2.95795 0.369487C3.29295 0.428487 3.54795 0.706487 3.57695 1.04649L3.81194 3.84749C18.0879 3.85349 18.1339 3.86049 18.2029 3.86849C18.7599 3.94949 19.2499 4.24049 19.5839 4.68849C19.9179 5.13549 20.0579 5.68649 19.9779 6.23849L19.0289 12.7965C18.8499 14.0445 17.7659 14.9855 16.5059 14.9855H16.5009H5.59295H5.58495Z" fill="currentColor"></path>
                                        </svg>
                                        <span class="tp-product-tooltip">Agregar Carrito</span>
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
                                <span class="tp-product-price new-price">S/. ${product.prod_precio}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML("beforeend", productHTML);
        });
    }
});




