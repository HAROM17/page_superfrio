


function procesarPedido() {
    const baseUrl = document.body.dataset.baseUrl;
    const formData = new FormData();

    // Verificar y agregar el carrito al FormData
    if (Array.isArray(carritoItems) && carritoItems.length > 0) {
        formData.append("carrito", JSON.stringify(carritoItems));
        const totalProductos = carritoItems.reduce((total, item) => total + item.cantidad, 0);

        if (totalProductos < 80) {
            Swal.fire({
                icon: "warning",
                title: "Tiene que tener 80 productos en el carrito",
                text: "para proceder con el pago",
                timer: 3000, // Cierra automáticamente después de 2 segundos
                showConfirmButton: false
            });
            return;
        }
    } else {
        Swal.fire({
            icon: "warning",
            title: "El carrito esta vacio",
            timer: 2000, // Cierra automáticamente después de 2 segundos
            showConfirmButton: false
        });
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
        Swal.fire({
            icon: "warning",
            title: "Complete todos los campos de detalle del cliente",
            timer: 2000, // Cierra automáticamente después de 2 segundos
            showConfirmButton: false
        });
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
        Swal.fire({
            icon: "warning",
            title: "Por Favor selecione un metodo de pago",
            timer: 2000, // Cierra automáticamente después de 2 segundos
            showConfirmButton: false
        });
        return;
    }

    const metodoPagoId = metodoPagoSeleccionado.value; // ID del método de pago

    // Manejar métodos de pago
    if (metodoPagoId === "2") { // Yape seleccionado
        const imageInput = document.getElementById("image-upload");

        // Validar si hay un archivo seleccionado (voucher)
        if (imageInput.files.length > 0) {
            formData.append("voucher", imageInput.files[0]); // Agregar el archivo seleccionado
        } else {
            Swal.fire({
                icon: "warning",
                title: "Por favor, adjunte el comprobante de pago antes de realizar el pedido",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Aceptar"
            });
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

    Swal.fire({
        title: "¿Está seguro?",
        text: "¿Desea realizar el pedido?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, realizar pedido",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
    }).then((result) => {
        if (result.isConfirmed) {
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
                    Swal.fire({
                        title: "¡Pedido realizado con éxito!",
                        text: "Su pedido ha sido procesado correctamente.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = `${baseUrl}view/pedido-confirmado/?pedido_id=${data.pedido_id}`;
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Error al realizar el pedido: " + data.message,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema al procesar su pedido. Intente nuevamente más tarde.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            });
        } else {
            console.log("Pedido cancelado por el usuario.");
        }
    });
    
}

// Asignar la función al botón
document.querySelector(".tp-checkout-btn").addEventListener("click", function (e) {
    e.preventDefault();
    procesarPedido();
});


// mostrar form de tarejtas (inhabilitado por ahora)
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



// Funciones para msubir y mostrar voucher
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
