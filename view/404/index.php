<?php
require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_backend = Conectar::ruta_backend();

?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Helados Super Frios</title>

    <?php require_once("../modules/head.php"); ?>

    <link href="404.css" rel="stylesheet" type="text/css" />

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <div class="layout-wrapper landing">

        <?php require_once("../modules/nav.php"); ?>
<br>
        <section class="section bg-dark-custom full-height" id="productos">

            <div class="auth-page-wrapper pt-5">
                <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                    <div class="bg-overlay"></div>

                    <div class="shape">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                            <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                        </svg>
                    </div>
                </div>

                <div class="auth-page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center mt-sm-5 pt-4 mb-4">
                                    <div class="mb-sm-5 pb-sm-4 pb-5">
                                        <img src="<?php echo $url; ?>assets/imagenes/footer_logo.png" alt="" height="120" class="move-animation">
                                    </div>
                                    <div class="mb-5">
                                        <h1 class="display-2 coming-soon-text">MUY PRONTO</h1>
                                    </div>
                                    <div>
                                        <div class="mt-5">
                                            <h4>Recibe una notificación cuando lancemos</h4>
                                            <p class="text-muted">No te preocupes, no te enviaremos spam 😊</p>
                                        </div>
                                        <div class="input-group countdown-input-group mx-auto my-4">
                                            <input type="email" class="form-control border-light shadow" placeholder="Escribe Tu Gmail" aria-label="search result" aria-describedby="button-email">
                                            <button class="btn btn-success" type="button" id="button-email">Enviar<i class="ri-send-plane-2-fill align-bottom ms-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <p class="mb-0 text-muted">&copy;
                                            <script>
                                                document.write(new Date().getFullYear())
                                            </script> Helados Super Frios <i class="mdi mdi-heart text-danger"></i> by @Harom_Dev
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
        </section>
    </div>
    <?php require_once("../modules/js.php"); ?>
</body>

</html>