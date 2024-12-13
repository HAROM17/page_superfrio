<?php

session_start();

require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_back = Conectar::ruta_back();

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Carrito de Compra</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php require_once("../modules/head.php") ?>
</head>

<body data-is-authenticated="<?= isset($_SESSION['cli_id']) ? 'true' : 'false' ?>">

    <?php require_once("../modules/loading.php") ?>

    <div class="body-overlay"></div>

    <?php require_once("../modules/sidebar.mov.php") ?>


    <?php require_once("../modules/menu.inferior.mov.php") ?>


    <?php require_once("../modules/seccion.carrito.php") ?>


    <?php require_once("../modules/header.php") ?>


    <?php require_once("../modules/header.flo.php") ?>

    <main>
        <section class="breadcrumb__area include-bg pt-95 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <h3 class="breadcrumb__title">Shopping Cart</h3>
                            <div class="breadcrumb__list">
                                <span><a href="#">Home</a></span>
                                <span>Shopping Cart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- cart area start -->
        <section class="tp-cart-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="tp-cart-list mb-25 mr-30">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="tp-cart-header-product">Producto</th>
                                        <th class="tp-cart-header-price">Precio</th>
                                        <th class="tp-cart-header-quantity">Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cart-items-container">
                                    <!-- Los productos se agregarán dinámicamente aquí -->
                                </tbody>
                            </table>
                        </div>
                        <div class="tp-cart-bottom">
                            <div class="row align-items-end">
                                <div class="col-xl-6 col-md-4">
                                    <div class="tp-cart-update text-md-end">
                                        <button id="update-cart-btn" type="button" class="tp-cart-update-btn">Actualizar Carrito</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="tp-cart-checkout-wrapper">
                            <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                                <span class="tp-cart-checkout-top-title">Subtotal</span>
                                <span id="cart-subtotal" class="tp-cart-checkout-top-price">$0.00</span>
                            </div>
                            <div class="tp-cart-checkout-total d-flex align-items-center justify-content-between">
                                <span>Total</span>
                                <span id="cart-total">$0.00</span>
                            </div>
                            <div class="tp-cart-checkout-proceed">
                                <a href="<?php echo $url ?>view/finalizar-compra/" class="tp-cart-checkout-btn w-100">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cart area end -->
    </main>


    <?php require_once("../modules/footer.php"); ?>



    <!-- JS here -->
    <script src="https://accounts.google.com/gsi/client" async></script>
    <?php require_once("../modules/js.php") ?>

    <script src="<?php echo $url ?>assets/js/template2/login2.js"></script>
    <script src="<?php echo $url ?>assets/js/template2/menu_movil2.js"></script>
    <script src="carrito.js"></script>
</body>

</html>