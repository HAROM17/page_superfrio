<?php
require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_backend = Conectar::ruta_backend();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["cli_id"])) {
    header("Location: " . $url);
    exit();
}

?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Helados Super Frios</title>

    <?php require_once("../modules/head.php"); ?>


</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <div class="layout-wrapper landing">
        <?php require_once("../modules/nav.php"); ?>
        <br>
        <section class="section bg-dark-custom full-height">
            <div class="auth-page-wrapper pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Crear una nueva cuenta</h5>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form id="registro_form" class="needs-validation" novalidate>
                                            <div class="mb-3">
                                                <label for="cli_correo" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="cli_correo" name="cli_correo" placeholder="Enter email address" required>
                                                <div class="invalid-feedback">Por favor, ingresa un correo electrónico válido.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="cli_pass">Contraseña</label>
                                                <div class="position-relative auth-pass-inputgroup">
                                                    <input type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" id="cli_pass" name="cli_pass" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    <div class="invalid-feedback">Por favor, ingresa una contraseña válida.</div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" type="submit">Crear Cuenta</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="mb-0">Already have an account ? <a href="auth-signin-basic.html" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once("../modules/js.php"); ?>
    <script type="text/javascript" src="register.js"></script>
</body>

</html>