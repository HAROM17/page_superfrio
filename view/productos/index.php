<?php

session_start();

require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_back = Conectar::ruta_back();

require_once("../../model/model.empresa.php");
// Crear instancia y obtener la información de la empresa
$empresa = new Empresa();
$infoemp = $empresa->obtenerInfoEmpresa(1); // Cambia "1" por el ID correcto de la empresa
if ($infoemp) {
    $logo = $infoemp['emp_logo'];
    $nombreEmpresa = $infoemp['emp_nom'];
    $correo = $infoemp['emp_correo'];
    $telefono = $infoemp['emp_telef'];
    $direccion = $infoemp['emp_direc'];
} else {
    echo "No se encontró información de la empresa.";
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Productos por Categorias</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php require_once("../modules/head.php") ?>
</head>

<body data-is-authenticated="<?= isset($_SESSION['cli_id']) ? 'true' : 'false' ?>" data-base-url="<?php echo $url; ?>" >

    <?php require_once("../modules/loading.php") ?>
    <?php require_once("../modules/sidebar.mov.php") ?>

    <div class="body-overlay"></div>

    <?php require_once("../modules/menu.inferior.mov.php") ?>
    <?php require_once("../modules/seccion.buscar.mov.php") ?>
    <?php require_once("../modules/seccion.carrito.php") ?>
    <?php require_once("../modules/header.php") ?>
    <?php require_once("../modules/header.flo.php") ?>

    <main>
        <section class="tp-product-area pb-55">
            <div class="container">
                <!-- botones -->
                <div class="row align-items-end">
                    <div class="tp-section-title-wrapper mb-40" style="text-align: center;">
                        <h4 class="tp-section-title" id="categorianombre">

                        </h4>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-5">
                        <div class="tp-section-title-wrapper mb-40">
                            <h3 class="tp-section-title" id="subcategorianombre">

                            </h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-product-tab-content">
                            <div class="tab-content" id="myTabContent">
                                <!-- PRODUCTOS NUEVOS -->
                                <div class="tab-pane fade show active" id="new-tab-pane" role="tabpanel" aria-labelledby="new-tab" tabindex="0">
                                    <div class="row row-cols-xl-5 row-cols-lg-5 row-cols-md-4 justify-content-center" id="new-products-container">
                                        <!-- Aquí se agregarán dinámicamente los productos -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once("../modules/ver.producto.php") ?>
    </main>


    <?php require_once("../modules/footer.php"); ?>


    <!-- JS here -->
    <script src="https://accounts.google.com/gsi/client" async></script>
    <?php require_once("../modules/js.php") ?>

    <script src="<?php echo $url ?>assets/js/LoginRegistro.js"></script>
    <script src="<?php echo $url ?>assets/js/FuncionesButton.js"></script>
    <script src="productos.js"></script>

</body>

</html>