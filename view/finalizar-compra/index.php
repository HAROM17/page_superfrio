<?php

session_start();

require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_back = Conectar::ruta_back();

require_once("../../model/model.cliente.php");
$cli_id = $_SESSION['cli_id'];
$emp_id = $_SESSION['emp_id'];

$clienteModel = new Cliente();
$cliente = $clienteModel->getCliente($cli_id, $emp_id);
require_once("../../model/model.carrito.php");
$carritoModel = new Carrito();
$carritoItems = $carritoModel->getCartItems($cli_id, $emp_id);
$totalGeneral = 0;

if (!isset($_SESSION['cli_id']) || !isset($_SESSION['emp_id'])) {
    echo "<script>alert('Por favor, inicie sesión primero.'); window.location.href='../../login.php';</script>";
    exit;
}



if (!$cliente) {
    echo "<script>alert('Cliente no encontrado.'); window.location.href='../../index.php';</script>";
    exit;
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Finalizar Compra</title>
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
        <section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="#EFF1F5">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content p-relative z-index-1">
                            <h3 class="breadcrumb__title">Verificar</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

        <!-- checkout area start -->
        <section class="tp-checkout-area pb-120" data-bg-color="#EFF1F5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Detalles</h3>

                            <div class="tp-checkout-bill-form">
                                <form action="#">
                                    <div class="tp-checkout-bill-inner">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Nombre <span>*</span></label>
                                                    <input type="text" placeholder="Nombre" value="<?php echo htmlspecialchars($cliente['cli_nom']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Apellido <span>*</span></label>
                                                    <input type="text" placeholder="Apellido" value="<?php echo htmlspecialchars($cliente['cli_ape']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>DNI <span>*</span></label>
                                                    <input type="text" placeholder="DNI" value="<?php echo htmlspecialchars($cliente['cli_dni']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Numero de Celular <span>*</span></label>
                                                    <input type="text" placeholder="" value="<?php echo htmlspecialchars($cliente['cli_telf']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Dirección </label>
                                                    <input type="text" placeholder="ingrese direccion, nombre de la calle" value="<?php echo htmlspecialchars($cliente['cli_direc']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Dirección de correo electrónico <span>*</span></label>
                                                    <input type="email" placeholder="" value="<?php echo htmlspecialchars($cliente['cli_correo']); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- checkout place order -->
                        <div class="tp-checkout-place white-bg">
                            <h3 class="tp-checkout-place-title">Su Pedido</h3>

                            <div class="tp-order-info-list">
    <ul>
        <!-- header -->
        <li class="tp-order-info-list-header">
            <h4>Productos</h4>
            <h4>Cantidad</h4>
            <h4>Total</h4>
        </li>

        <!-- item list -->
        <?php if (!empty($carritoItems)) : ?>
            <?php foreach ($carritoItems as $item) : 
                $subtotal = $item['prod_precio'] * $item['cantidad'];
                $totalGeneral += $subtotal;
            ?>
            
                <li class="tp-order-info-list-desc">
                    <dt>
                    <p><?php echo htmlspecialchars($item['subcategory_name']); ?> </p>
                    <p> <?php echo htmlspecialchars($item['flavor_name']); ?></p>
                    </dt>
                    <p><span> x <?php echo $item['cantidad']; ?></span></p>
                    <span>S/ <?php echo number_format($subtotal, 2); ?></span>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li class="tp-order-info-list-desc">
                <p>No hay productos en el carrito.</p>
            </li>
        <?php endif; ?>

        <!-- total -->
        <li class="tp-order-info-list-total">
            <span>Total</span>
            <span>S/ <?php echo number_format($totalGeneral, 2); ?></span>
        </li>
    </ul>
</div>

                            <div class="tp-checkout-payment">


                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="cod" name="payment">
                                    <label for="cod">Yape</label>
                                    <div class="tp-checkout-payment-desc cash-on-delivery">
                                        <p>Paga aqui con Yape : 956 854 187
                                            <img src="<?php echo $url ?>assets/img/yape/yape.jpg"
                                                alt="Bank Payment Illustration"
                                                style="width: 200px; height: auto; margin-top: 10px; display: block; margin-left: auto; margin-right: auto;">
                                        </p>
                                        <form method="POST" enctype="multipart/form-data" style="margin-top: 20px; text-align: center;">
                                            <input type="file" id="image-upload" name="image" accept="image/*" style="display: inline-block;">
                                            <div id="preview" style="margin-top: 20px; text-align: center;">
                                                <!-- Aquí se mostrará la imagen -->
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="tp-checkout-agree">
                                <div class="tp-checkout-option">
                                    <input id="read_all" type="checkbox">
                                    <label for="read_all">I have read and agree to the website.</label>
                                </div>
                            </div>
                            <div class="tp-checkout-btn-wrapper">
                                <a href="#" class="tp-checkout-btn w-100">Realizar Pedido</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- checkout area end -->
        <script>
            const cli_id = <?php echo json_encode($_SESSION['cli_id']); ?>;
            const emp_id = <?php echo json_encode($_SESSION['emp_id']); ?>;
            const carritoItems = <?php echo json_encode($carritoItems); ?>;
        </script>


    </main>


    <?php require_once("../modules/footer.php"); ?>


    <script src="https://accounts.google.com/gsi/client" async></script>
    <?php require_once("../modules/js.php") ?>

    <script src="<?php echo $url ?>assets/js/template2/login2.js"></script>
    <script src="<?php echo $url ?>assets/js/template2/menu_movil2.js"></script>
    <script src="finalizar.compra.js"></script>
</body>

</html>
