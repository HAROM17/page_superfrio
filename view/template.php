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

<body data-is-authenticated="<?= isset($_SESSION['cli_id']) ? 'true' : 'false' ?>" data-base-url="<?php echo $url; ?>">

    <?php require_once("modules/loading.php") ?>


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
    <?php require_once("modules/js.php") ?>
    <script src="<?php echo $url ?>assets/js/LoginRegistro.js"></script>
    <script src="<?php echo $url ?>assets/js/FuncionesButton.js"></script>
    <script src="<?php echo $url ?>assets/js/Productos.js"></script>
    
</body>

</html>