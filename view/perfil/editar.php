<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_backend = Conectar::ruta_backend();

if (isset($_SESSION["cli_id"])) {

?>

    <!doctype html>
    <html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

    <head>
        <meta charset="utf-8" />
        <title>Editar Perfil</title>
        <?php require_once("../modules/head.php"); ?>
    </head>

    <body data-bs-spy="scroll" data-bs-target="#navbar-example">
        <div class="layout-wrapper landing">
            <?php require_once("../modules/nav.php"); ?>

            <section class="section bg-light">
                <div class="container">
                    <div class="page-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xxl-3">
                                    <div class="card mt-n5">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                    <img src="" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="imagen de perfil de usuario">
                                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                        <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                                <i class="ri-camera-fill"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <h5 class="fs-16 mb-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Ana Adame</font>
                                                    </font>
                                                </h5>
                                                <p class="text-muted mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Diseñador/Desarrollador Líder</font>
                                                    </font>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xxl-9">
                                    <div class="card mt-xxl-n5">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                                        <i class="fas fa-home"></i>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Detalles personales
                                                            </font>
                                                        </font>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false">
                                                        <i class="far fa-user"></i>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Cambiar la contraseña
                                                            </font>
                                                        </font>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link " data-bs-toggle="tab" href="#privacy" role="tab" aria-selected="true">
                                                        <i class="far fa-envelope"></i>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Eliminar Cuenta
                                                            </font>
                                                        </font>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                                    <form action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="firstnameInput" class="form-label">Nombre:</label>
                                                                    <input type="text" class="form-control" id="firstnameInput" placeholder="Ingre su nombre" value="">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="lastnameInput" class="form-label">Apellido</label>
                                                                    <input type="text" class="form-control" id="lastnameInput" placeholder="Ingrese su apellido" value="">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="phonenumberInput" class="form-label">Numero:</label>
                                                                    <input type="text" class="form-control" id="phonenumberInput" placeholder="Ingrese Numero" value="">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="emailInput" class="form-label">Correo Electronico*</label>
                                                                    <input type="email" class="form-control" placeholder="Ingrese Correo Electronico" id="emailInput" value="">
                                                                </div>
                                                            </div>
                                                         
                                                            <div class="col-lg-12">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                                    <button type="button" onclick="cancelaredicion()" class="btn btn-soft-success">Cancelar</button>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <!--end row-->
                                                    </form>
                                                </div>

                                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                                    <form action="javascript:void(0);">
                                                        <div class="row g-2">
                                                            <div class="col-lg-4">
                                                                <div>
                                                                    <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                                    <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div>
                                                                    <label for="newpasswordInput" class="form-label">New Password*</label>
                                                                    <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-4">
                                                                <div>
                                                                    <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                                    <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-12">
                                                                <div class="text-end">
                                                                    <button type="submit" class="btn btn-success">Change Password</button>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <!--end row-->
                                                    </form>
                                                </div>
                                                <!--end tab-pane-->
                                                <div class="tab-pane " id="privacy" role="tabpanel">
                                                    
                                                    <div>
                                                        <h5 class="card-title text-decoration-underline mb-3">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">Eliminar esta cuenta:</font>
                                                            </font>
                                                        </h5>
                                                        

                                                        <div class="hstack gap-2 mt-3">
                                                            <!-- Suponiendo que $_SESSION["cli_id"] contiene el ID del cliente actual -->
                                                            <a href="javascript:void(0);" class="btn btn-soft-danger" onclick="eliminarcuenta('<?php echo $_SESSION["cli_id"]; ?>')">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Cerrar y eliminar esta cuenta</font>
                                                                </font>
                                                            </a>

                                                            <a href="javascript:void(0);" class="btn btn-light">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Cancelar</font>
                                                                </font>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end tab-pane-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!--end row-->

                        </div>
                        <!-- container-fluid -->
                    </div>
                </div>
            </section>
        </div>
        <?php require_once("../modules/js.php"); ?>
        <script type="text/javascript" src="editar.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location:" . Conectar::ruta() . "view/login/login.php?e=1");
}
?>