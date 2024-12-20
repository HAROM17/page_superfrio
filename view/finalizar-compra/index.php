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
    $url = Conectar::ruta(); // Reemplaza con tu ruta dinámica
    echo "<script>alert('Por favor, inicie sesión primero.'); window.location.href='" . $url . "';</script>";
    exit;
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Finalizar Compra</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    </link>
    <?php require_once("../modules/head.php") ?>
</head>

<body data-is-authenticated="<?= isset($_SESSION['cli_id']) ? 'true' : 'false' ?>" data-base-url="<?php echo $url; ?>">

    <?php require_once("../modules/loading.php") ?>

    <div class="body-overlay"></div>

    <?php require_once("../modules/sidebar.mov.php") ?>


    <?php require_once("../modules/menu.inferior.mov.php") ?>

    <?php require_once("../modules/seccion.buscar.mov.php") ?>


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
                            <h3 class="tp-checkout-bill-title">Detalles Del Cliente</h3>
                            <div class="tp-checkout-bill-form">
                                <form id="cliente-form">
                                    <div class="tp-checkout-bill-inner">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Nombre <span>*</span></label>
                                                    <input type="text" name="nombres" id="nombres" placeholder="Nombre" value="<?php echo htmlspecialchars($cliente['cli_nom']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Apellido <span>*</span></label>
                                                    <input type="text" name="apellidos" id="apellidos" placeholder="Apellido" value="<?php echo htmlspecialchars($cliente['cli_ape']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>DNI <span>*</span></label>
                                                    <input type="text" name="dni" id="dni" placeholder="DNI" value="<?php echo htmlspecialchars($cliente['cli_dni']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Numero de Celular <span>*</span></label>
                                                    <input type="text" name="telefono" id="telefono" placeholder="" value="<?php echo htmlspecialchars($cliente['cli_telf']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Dirección <span>*</span></label>
                                                    <input type="text" name="direccion" id="direccion" placeholder="Ingrese dirección, nombre de la calle" value="<?php echo htmlspecialchars($cliente['cli_direc']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Dirección de correo electrónico <span>*</span></label>
                                                    <input type="email" name="correo" placeholder="" value="<?php echo htmlspecialchars($cliente['cli_correo']); ?>" readonly>
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
                                        <h4>SubTotal</h4>
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
                                    <input type="radio" id="back_transfer" name="payment" value="2">
                                    <label for="back_transfer" data-bs-toggle="direct-bank-transfer">Yape</label>
                                    <div class="tp-checkout-payment-desc direct-bank-transfer">
                                        <p>Paga aqui con Yape: 956 854 187
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
                                <div class="tp-checkout-payment-item" style="display: none;">
                                    <input type="radio" id="cheque_payment" name="payment" value="3">
                                    <label for="cheque_payment">Tarjeta</label>
                                    <div class="tp-checkout-payment-desc cheque-payment" style="display: none;">
                                        <p>Ingrese los datos de su tarjeta:</p>

                                    </div>
                                </div>
                                <div class="tp-checkout-bill-form" id="tarjeta-detalles2" style="display: none;">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label for="numero-tarjeta">Número de tarjeta <span>*</span></label>
                                                    <input type="text" id="numero-tarjeta" placeholder="Número de tarjeta" style="width: 100%; margin-bottom: 10px;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label for="fecha-expiracion">(MM/AA) <span>*</span></label>
                                                    <input type="text" id="fecha-expiracion" placeholder="MM/AA" style="width: 100%; margin-bottom: 10px;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label for="cvv">CVV <span>*</span></label>
                                                    <input type="text" id="cvv" placeholder="CVV" style="width: 100%; margin-bottom: 10px;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="tp-checkout-agree">
                                <div class="tp-checkout-option">
                                    <input id="read_all" type="checkbox">
                                    <label for="read_all">He leído y acepto los términos</label>
                                    <p id="terms-error" style="color: red; font-size: 0.9em; display: none;">Debes aceptar los términos para continuar.</p>
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

        <script>
            const cli_id = <?php echo json_encode($_SESSION['cli_id']); ?>;
            const emp_id = <?php echo json_encode($_SESSION['emp_id']); ?>;
            const carritoItems = <?php echo json_encode($carritoItems); ?>;
        </script>


    </main>


    <?php require_once("../modules/footer.php"); ?>



    <script src="https://accounts.google.com/gsi/client" async></script>
    <?php require_once("../modules/js.php") ?>

    <script src="<?php echo $url ?>assets/js/LoginRegistro.js"></script>
    <script src="<?php echo $url ?>assets/js/FuncionesButton.js"></script>
    <script src="finalizar.compra.js"></script>
</body>

</html>