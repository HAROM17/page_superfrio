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


if (isset($_POST["enviar"]) && $_POST["enviar"] == "si") {
    require_once("../../model/model.cliente.php");
    $cliente = new Cliente();
    $cliente->loginCliente();
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
                <div class="auth-page-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-5">
                                <div class="card mt-4">
                                    <div class="card-body p-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary">¡Bienvenido de nuevo!</h5>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <form class="sign-box" method="post" id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <div class="mb-3">
                                                    <label for="cli_correo" class="form-label">Correo Electrónico</label>
                                                    <input type="email" class="form-control" id="cli_correo" name="cli_correo" placeholder="Ingrese su correo electrónico">
                                                </div>
                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="auth-pass-reset-basic.html" class="text-muted">¿Has olvidado tu contraseña?</a>
                                                    </div>
                                                    <label class="form-label">Contraseña</label>
                                                    <input type="password" class="form-control" id="cli_pass" name="cli_pass" placeholder="Ingrese su contraseña">
                                                </div>
                                                <input type="hidden" id="emp_id" name="emp_id" value="<?php echo isset($_GET['e']) ? $_GET['e'] : ''; ?>">
                                                <div class="mt-4">
                                                    <input type="hidden" name="enviar" class="form-control" value="si">
                                                    <button class="btn btn-success w-100" type="submit">Iniciar Sesión</button>
                                                </div>
                                                <div class="mt-4 text-center">
                                                    <div class="signin-other-title">
                                                        <h5 class="fs-13 mb-4 title">Inicia sesión con:</h5>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="http://localhost/sistema_tropical/" target="_blank" class="btn btn-dark">Acceder al sistema<i class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                                <div class="mt-4 text-center">
                                    <p class="mb-0">¿No tienes una cuenta? <a href="auth-signup-basic.html" class="fw-semibold text-primary text-decoration-underline">Crear Cuenta</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once("../modules/js.php"); ?>
</body>
</html>
