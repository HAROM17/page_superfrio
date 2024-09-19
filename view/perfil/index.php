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
        <title>Perfil</title>
        <?php require_once("../modules/head.php"); ?>
    </head>

    <body data-bs-spy="scroll" data-bs-target="#navbar-example">
        <div class="layout-wrapper landing">
            <?php require_once("../modules/nav.php"); ?>
            <section class="section bg-light" id="productos">
                <br><br><br>
                <div class="container">
                    <div class="container-fluid">
                        <div class="profile-foreground position-relative mx-n4 mt-n4">
                            <div class="profile-wid-bg"></div>
                        </div>
                        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                            <div class="row g-4">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="<?php echo $url_backend ?>assets/imagenes/clientes/<?php echo $_SESSION["cli_img"]; ?>" alt="img de usuario" class="img-thumbnail rounded-circle">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="p-2">
                                        <h3 class="text-white mb-1"><?php echo $_SESSION["cli_nom"] . " " . $_SESSION["cli_ape"]; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Descripción General</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                                <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Activities</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="flex-shrink-0">
                                        <a href="<?php echo $url ?>view/perfil/editar.php" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i>Editar perfil</a>
                                    </div>
                                </div>

                                <div class="tab-content pt-4 text-muted">
                                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                        <div class="row">
                                            <div class="col-xxl-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-4">Información</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Nombre completo :</th>
                                                                        <td class="text-muted"><?php echo $_SESSION["cli_nom"] . " " . $_SESSION["cli_ape"]; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Móvil :</th>
                                                                        <td class="text-muted"><?php echo $_SESSION["cli_telf"]; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Correo electrónico :</th>
                                                                        <td class="text-muted"><?php echo $_SESSION["cli_correo"]; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Dirección :</th>
                                                                        <td class="text-muted"><?php echo $_SESSION["cli_direc"]; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Dia de ingreso :</th>
                                                                        <td class="text-muted">
                                                                            <?php
                                                                            $meses_espanol = array(
                                                                                '01' => 'enero',
                                                                                '02' => 'febrero',
                                                                                '03' => 'marzo',
                                                                                '04' => 'abril',
                                                                                '05' => 'mayo',
                                                                                '06' => 'junio',
                                                                                '07' => 'julio',
                                                                                '08' => 'agosto',
                                                                                '09' => 'septiembre',
                                                                                '10' => 'octubre',
                                                                                '11' => 'noviembre',
                                                                                '12' => 'diciembre'
                                                                            );
                                                                            $numero_mes = date('m', strtotime($_SESSION["fech_crea"]));
                                                                            $nombre_mes = $meses_espanol[$numero_mes];
                                                                            $fecha_formateada = date("d", strtotime($_SESSION["fech_crea"])) . ' de ' . $nombre_mes . ' de ' . date("Y h:i A", strtotime($_SESSION["fech_crea"]));

                                                                            echo $fecha_formateada;
                                                                            ?>

                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="activities" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Actividades</h5>
                                                <div class="activity-timeline">
                                                    <div class="activity-item d-flex mb-4">
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Oliver Phillips <span class="badge bg-soft-primary text-primary align-middle">New</span></h6>
                                                            <p class="text-muted mb-2">We talked about a project on LinkedIn.</p>
                                                            <small class="mb-0 text-muted">Today</small>
                                                        </div>
                                                    </div>
                                                    <div class="activity-item d-flex mb-4">
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Nancy Martino <span class="badge bg-soft-secondary text-secondary align-middle">In Progress</span></h6>
                                                            <p class="text-muted mb-2"><i class="ri-file-text-line align-middle ms-2"></i> Create new project Building product</p>
                                                            <small class="mb-0 text-muted">Yesterday</small>
                                                        </div>
                                                    </div>
                                                    <div class="activity-item d-flex">
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Natasha Carey <span class="badge bg-soft-success text-success align-middle">Completed</span></h6>
                                                            <p class="text-muted mb-2">Adding a new event with attachments</p>
                                                            <small class="mb-0 text-muted">25 Nov</small>
                                                        </div>
                                                    </div>
                                                </div>
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

<?php
} else {
    header("Location:" . Conectar::ruta() . "view/login/login.php?e=1");
}
?>