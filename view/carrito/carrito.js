document.addEventListener("DOMContentLoaded", function () {
    // Todas las funciones que interactúan con el DOM aquí
    loadCartTable();
});


// Función para eliminar un producto del carrito
function eliminarProductoCarrito(cartId, callback) {
    const baseUrl = document.body.dataset.baseUrl;

    fetch(`${baseUrl}controller/controller.carrito.php?op=remove_from_cart`, {
        method: "POST",
        body: new URLSearchParams({ carrito_id: cartId }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: "success",
                title: "Producto eliminado del carrito",
                timer: 2000,
                showConfirmButton: false
            });

            if (callback) {
                callback(); // Ejecuta la función callback si se proporciona
            }
        } else {
            console.error("Error al eliminar producto:", data.message);
        }
    })
    .catch(error => {
        console.error("Error en la solicitud de eliminación:", error);
    });
}

// Función principal para cargar la tabla del carrito
function loadCartTable() {
    fetch("../../controller/controller.carrito.php?op=listar_carrito", {
        method: "POST",
        body: new URLSearchParams({ emp_id: 1 }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderCartTable(data.productos, data.ruta_base);
            } else {
                console.error("Error al cargar la tabla del carrito:", data.message);
            }
        })
        .catch(error => console.error("Error al cargar los datos de la tabla del carrito:", error));
}

// Función para renderizar los productos en la tabla
function renderCartTable(cartItems, rutaBase) {
    const cartTableBody = document.querySelector("#cart-items-container");
    cartTableBody.innerHTML = ""; // Limpiar la tabla

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
                <td class="tp-cart-quantity">
                    <div class="tp-product-quantity">
                        <span class="tp-cart-minus">-</span>
                        <input class="tp-cart-input" type="text" value="${item.cantidad}" 
                               data-cart-id="${item.carrito_id}" data-price="${item.prod_precio}">
                        <span class="tp-cart-plus">+</span>
                    </div>
                </td>
                <td>
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

// Función para calcular totales
function calculateTotals() {
    let subtotal = 0;
    document.querySelectorAll(".tp-cart-input").forEach(input => {
        const price = parseFloat(input.dataset.price);
        const quantity = parseInt(input.value);
        subtotal += price * quantity;
    });
    document.getElementById("cart-subtotal").textContent = `S/ ${subtotal.toFixed(2)}`;
    document.getElementById("cart-total").textContent = `S/ ${subtotal.toFixed(2)}`;
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito(carritoId) {
    fetch("../../controller/controller.carrito.php?op=delete_cart_item", {
        method: "POST",
        body: new URLSearchParams({ carrito_id: carritoId }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Producto eliminado del carrito.",
                    timer: 2000,
                    showConfirmButton: false
                });
                loadCartTable();
                updateCartCount();
            } else {
                alert("No se pudo eliminar el producto del carrito.");
            }
        })
        .catch(error => console.error("Error al eliminar el producto:", error));
}

// Función para actualizar los ítems del carrito
function actualizarCarrito() {
    const updatedItems = [];
    document.querySelectorAll(".tp-cart-input").forEach(input => {
        updatedItems.push({
            carrito_id: input.dataset.cartId,
            cantidad: parseInt(input.value, 10)
        });
    });

    // Validación: si no hay productos
    if (updatedItems.length === 0) {
        Swal.fire({
            icon: "warning",
            title: "Carrito Vacío",
            text: "No hay productos en el carrito",
            timer: 2000,
            showConfirmButton: false
        });
        return;
    }

    fetch("../../controller/controller.carrito.php?op=update_cart_items", {
        method: "POST",
        body: JSON.stringify({ items: updatedItems }),
        headers: { "Content-Type": "application/json" }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Carrito actualizado",
                    timer: 2000,
                    showConfirmButton: false
                });
                loadCartTable();
                updateCartCount();
            } else {
                alert("Error al actualizar el carrito.");
            }
        })
        .catch(error => console.error("Error al actualizar el carrito:", error));
}

// Función para actualizar contador del carrito
function updateCartCount() {
    fetch("../../controller/controller.carrito.php?op=get_cart_count")
        .then(response => response.json())
        .then(data => {
            document.querySelectorAll("[data-cart-count]").forEach(el => el.textContent = data.count);
        });
}

// Delegación de eventos para botones (+), (-) y eliminar
document.addEventListener("click", function (event) {
    const target = event.target;

    if (target.classList.contains("tp-cart-action-btn")) {
        const carritoId = target.getAttribute("data-carrito-id");
        if (carritoId) {
            eliminarDelCarrito(carritoId);
        }
    }

    const input = target.closest(".tp-product-quantity")?.querySelector(".tp-cart-input");
    if (target.classList.contains("tp-cart-plus") && input) {
        input.value = parseInt(input.value) + 1;
        calculateTotals();
    }
    if (target.classList.contains("tp-cart-minus") && input) {
        input.value = Math.max(parseInt(input.value) - 1, 1);
        calculateTotals();
    }
});

// Evento para el botón de actualizar carrito
document.getElementById("update-cart-btn")?.addEventListener("click", function () {
    actualizarCarrito();
});


window.loadCartTable = loadCartTable;