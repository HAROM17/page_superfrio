
$(document).ready(function() {
    $.ajax({
        url: "../../controller/controller.galeria_.php?op=listar",
        type: "post",
        data: { emp_id: 1 },
        success: function(data) {
            var response = JSON.parse(data);
            var galeriaData = response.aaData;

            // Limpiar el contenedor de la galería antes de agregar nuevos elementos
            $('.gallery-wrapper').empty();

            // Separar las galerías por tipo (fotos y videos)
            var fotosHTML = "";
            var videosHTML = "";

            $.each(galeriaData, function(index, galeria) {
                if (galeria[0].includes("fotos")) {
                    fotosHTML += galeria[0];
                } else if (galeria[0].includes("videos")) {
                    videosHTML += galeria[0];
                }
            });

            // Agregar primero las fotos y luego los videos al contenedor
            $('.gallery-wrapper').append(fotosHTML);
            $('.gallery-wrapper').append(videosHTML);

            // Re-inicializar GLightbox
            const lightbox = GLightbox({
                selector: '.image-popup',
                openEffect: 'zoom',
                closeEffect: 'fade'
            });

            // Re-inicializar Isotope
            var $grid = $('.gallery-wrapper').isotope({
                itemSelector: '.element-item',
                layoutMode: 'fitRows',
                filter: '.videos' 
            });

            // Filtros de Isotope
            $('#filter').on('click', 'a', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({ filter: filterValue });
                $('#filter a').removeClass('active');
                $(this).addClass('active');
                return false;
            });

        },
    });

    // Establecer el filtro de fotos como activo al cargar la página
    $('#filter a[data-filter=".videos"]').addClass('active');
});


$(document).ready(function() {
    // Verificar si hay una categoría seleccionada previamente en el almacenamiento local
    var selectedCategory = localStorage.getItem('selectedCategory');
    if (selectedCategory) {
        // Quitar la clase 'active' de todas las categorías
        $('.categories').removeClass('active');
        
        // Agregar la clase 'active' a la categoría previamente seleccionada
        $('.categories[data-filter="' + selectedCategory + '"]').addClass('active');
    }
});
/* generar videos */

init();





