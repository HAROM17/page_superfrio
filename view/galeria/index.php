<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_backend = Conectar::ruta_backend();
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Helados Super Frios.</title>
    <?php require_once("../modules/head.php"); ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    <div class="layout-wrapper landing">
        <?php require_once("../modules/nav.php"); ?>
        <br>
        <br>
        <section class="section bg-light" id="productos">
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <ul class="list-inline categories-filter animation-nav" id="filter">
                                                <li class="list-inline-item"><a class="categories" data-filter=".videos" id="btn-videos">Videos</a></li>
                                                <li class="list-inline-item"><a class="categories" data-filter=".fotos" id="btn-fotos">Fotos</a></li>

                                                <!-- <li class="list-inline-item"><a class="categories" data-filter="*">Ver Todo</a></li> -->
                                            </ul>
                                        </div>


                                        <div class="row gallery-wrapper" id="galeria_container">


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once("../modules/js.php"); ?>
    <script type="text/javascript" src="galeria.js"></script>

</body>

</html>