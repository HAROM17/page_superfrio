<?php 

    session_start();
    
    require_once("config/conexion.php");
    $url = Conectar::ruta();
    $url_back = Conectar::ruta_back();

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8"></meta>
    <meta http-equiv="x-ua-compatible" content="ie=edge"></meta>
    <title>Helados Y Chupetes Super Frios</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php require_once("modules/head.php")?>
</head>

<body>
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="tp-preloader-content">
                    <div class="tp-preloader-logo">
                        <div class="tp-preloader-circle">
                            <svg width="190" height="190" viewBox="0 0 380 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle>
                                <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle>
                            </svg>
                        </div>
                        <img src="assets/img/logo/icono.ico" height="120" alt="">
                    </div>
                    <h3 class="tp-preloader-title"></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTON PARA SUBIR -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>

    <?php require_once("modules/sidebar.mov.php") ?>


    <div class="body-overlay"></div>


    <!-- MENU INFERIOR -->
    <?php require_once("modules/menu.inferior.mov.php") ?>
    <!-- MENU INFERIOR -->

    <!-- BUSCADOR MOVIL-->
    <?php require_once("modules/seccion.buscar.mov.php") ?>
    <!-- BUSCADOR MOVIL -->

    <!-- MINI CARRITO -->
    <?php require_once("modules/seccion.carrito.php") ?>
    <!-- FIN MINI CARRITO -->

    <!-- HEADER -->
    <?php require_once("modules/header.php") ?>
    <!-- HEADER -->


    <!-- HEADER FLO -->
    <?php require_once("modules/header.flo.php") ?>
    <!-- HEADER FLO -->

    <main>
        <!-- SLIDE -->
        <?php require_once("modules/seccion.slider.php"); ?>
        <!-- SLIDE -->

        <!-- GATEGORIA -->
        <?php require_once("modules/seccion.categoria.php") ?>
        <!-- GATEGORIA -->

        <!-- INFO -->
        <?php require_once("modules/seccion.info.php") ?>
        <!-- INFO -->

        <!-- PRODUCTOS T --> 
        <?php require_once("modules/seccion.productoten.php") ?>
        <!-- PRODUCTOS T --> 

        <!-- GALERIA -->
        <?php require_once("modules/seccion.galeria.php") ?>
        <!-- GALERIA -->


        <!-- MODAL DETALLE O MAS -->
        <?php require_once("modules/ver.producto.php") ?>
        <!-- MODAL DETALLE O MAS -->
    </main>


    <!-- FOOTER -->
    <?php require_once("modules/footer.php") ?>
    <!-- FOOTER -->

    <!-- JS here -->
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="<?php echo $url ?>assets/js/vendor/jquery.js"></script>
    <script src="<?php echo $url ?>assets/js/vendor/waypoints.js"></script>
    <script src="<?php echo $url ?>assets/js/bootstrap-bundle.js"></script>
    <script src="<?php echo $url ?>assets/js/meanmenu.js"></script>
    <script src="<?php echo $url ?>assets/js/swiper-bundle.js"></script>
    <script src="<?php echo $url ?>assets/js/slick.js"></script>
    <script src="<?php echo $url ?>assets/js/range-slider.js"></script>
    <script src="<?php echo $url ?>assets/js/magnific-popup.js"></script>
    <script src="<?php echo $url ?>assets/js/nice-select.js"></script>
    <script src="<?php echo $url ?>assets/js/purecounter.js"></script>
    <script src="<?php echo $url ?>assets/js/countdown.js"></script>
    <script src="<?php echo $url ?>assets/js/wow.js"></script>
    <script src="<?php echo $url ?>assets/js/isotope-pkgd.js"></script>
    <script src="<?php echo $url ?>assets/js/imagesloaded-pkgd.js"></script>
    <script src="<?php echo $url ?>assets/js/ajax-form.js"></script>
    <script src="<?php echo $url ?>assets/js/main.js"></script>
    <script src="<?php echo $url ?>assets/js/login.js"></script>
    <script src="<?php echo $url ?>assets/js/menu_movil.js"></script>
    <script src="<?php echo $url ?>assets/js/producto.js"></script>
</body>

</html>