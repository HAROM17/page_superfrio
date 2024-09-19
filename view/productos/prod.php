<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_backend = Conectar::ruta_backend();

if (isset($_GET['subcat_id'])) {
    $subcat_id = intval($_GET['subcat_id']);

    // Preparar la llamada al procedimiento almacenado
    $stmt = Conectar::Conexion()->prepare("CALL mostrar_x_subcat(:subcat_id)");
    $stmt->bindParam(':subcat_id', $subcat_id, PDO::PARAM_INT);
    $stmt->execute();
    $productos = $stmt->fetchAll();
    $stmt->closeCursor();
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
        <section class="section bg-light" id="productos">
            <div class="container ">
                <div class="row justify-content-center row">
                    <div class="col-lg-12">
                        <br>
                        <?php if (isset($productos[0]['cat_nom'])) : ?>
                            <div class="col-lg-12">
                                <div class="text-center mb-5">
                                    <h1 class="mb-3 fw-semibold lh-base"><?php echo $productos[0]['cat_nom']; ?></h1>
                                </div>
                                <h2 class="mb-3 fw-semibold lh-base"><?php echo $productos[0]['subcat_nom']; ?></h2>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <?php
                    foreach ($productos as $item) {
                        $imageUrl = Conectar::ruta_backend() . "assets/imagenes/productos/" . $item["prod_img"];
                        echo '
                            <div class="col-lg-3 product-item">
                                <div class="card explore-box card-animate">
                                    <div class="explore-place-bid-img">
                                        <img src="' . $imageUrl . '" alt="" class="card-img-top explore-img" />
                                    </div>
                                    <div class="card-body">
                                        <h4 class="mb-1">' . $item["prod_nom"] . '</h4>
                                        <p class="text-muted mb-0">' . $item["sab_nom"] . '</p>
                                        <h5 class="text-primary mb-0">' . $item["prod_precio"] . '</h5>
                                    </div>
                                    
                                </div>
                            </div>';
                    }
                    ?>
                </div>
            </div>
    </div>
    </section>

    <?php require_once("../modules/footer.php"); ?>
    </div>
    <?php require_once("../modules/js.php"); ?>

</body>

</html>