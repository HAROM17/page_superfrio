function cancelaredicion() {
    window.location.href = 'index.php'; 
}

function eliminarcuenta(cli_id) {
    Swal.fire({
        html: '<div class="mt-3"><lord-icon src="../../assets/json/eliminar.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Desea Eliminar El Registro?</h4></div></div>',
        showCancelButton: true,
        confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
        cancelButtonClass: "btn btn-danger w-xs mb-1",
        buttonsStyling: false,
        confirmButtonText: "Sí",
        cancelButtonText: "Cancelar",
        input: 'password',
        inputPlaceholder: 'Ingresa tu contraseña',
        inputAttributes: {
            maxlength: 30,
            autocapitalize: 'off',
            autocorrect: 'off'
        },
        inputValidator: (value) => {
            if (!value) {
                return 'Debes ingresar tu contraseña para continuar';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var password = result.value;

            // Realizar la solicitud POST para eliminar la cuenta
            $.ajax({
                url: "../../controller/controller.cliente.php?op=eliminarcuenta",
                type: "POST",
                dataType: "json",
                data: {
                    cli_id: cli_id,
                    password: password
                },
                success: function(data) {
                    if (data.success) {
                        // Mostrar mensaje de eliminación exitosa
                        Swal.fire({
                            title: 'Registro Eliminado',
                            icon: 'success'
                        }).then(() => {
                            // Redirigir al inicio y forzar la recarga de la página
                            window.location.href = 'cuenta_Eliminada.php'; // Ajusta la ruta según la estructura de tu sitio
                        });

                        // Destruir la sesión directamente aquí después de eliminar la cuenta
                        $.ajax({
                            url: "../../controller/controller.cliente.php?op=destruirsesion",
                            type: "GET",
                            success: function(response) {
                                console.log('Sesión destruida.');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error al destruir la sesión:', error);
                            }
                        });

                    } else {
                        // Mostrar mensaje de error si la contraseña no coincide
                        Swal.fire({
                            title: 'Error',
                            text: 'La contraseña ingresada no es válida. Inténtalo de nuevo.',
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al eliminar la cuenta:', error);
                    // Mostrar mensaje de error genérico si falla la solicitud AJAX
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo eliminar la cuenta. Inténtalo de nuevo más tarde.',
                        icon: 'error'
                    });
                }
            });
        } else {
            // El usuario ha cancelado la eliminación, puedes agregar lógica adicional aquí si es necesario
            console.log('Eliminación cancelada por el usuario');
        }
    });
}
