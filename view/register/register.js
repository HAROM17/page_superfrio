function init() {
    $("#registro_form").on("submit", function(e) {
        registrarCliente(e);
    });
}

function registrarCliente(e) {
    e.preventDefault();
    var formData = new FormData($("#registro_form")[0]);
    formData.append('emp_id', 1);
    $.ajax({
        url: "../../controller/controller.cliente.php?op=registrar_cliente",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            swal.fire({
                title: 'Registro Confirmado',
                icon: 'success'
            });
        },
        error: function() {
            swal.fire({
                title: 'Error en el Registro',
                icon: 'error'
            });
        }
    });
}

init();
