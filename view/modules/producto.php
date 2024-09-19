<section class="section bg-light" id="productos">
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <h1 class="mb-3 fw-semibold lh-base">Explorar Productos</h1>
                </div>
                <div class="text-center mb-5">
                    <h2 class="mb-3 fw-semibold">Linea De Helados <span class="text-danger"> Artesanales</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $empresa_id = 1;
            $categoria_id = 1;
            ProductoController::ViewControllerProductoPorCategoria($empresa_id, $categoria_id);
            ?>
        </div>

        <br>

        <div class="row justify-content-center">
            <div class="text-center mb-5">
                <h2 class="mb-3 fw-semibold">Linea De Helados <span class="text-success"> Industriales</span></h2>
            </div>
        </div>
        <div class="row">
            <?php
            $empresa_id = 1;
            $categoria_id = 2;
            ProductoController::ViewControllerProductoPorCategoria($empresa_id, $categoria_id);
            ?>
        </div>
    </div>
</section>