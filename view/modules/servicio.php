<section class="section" id="servicio">
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="mb-3 ff-secondary fw-semibold lh-base">Los Mejores Servicios</h1>
                </div>
            </div>

        </div>
        <!-- end row -->

        <div class="row g-3">

            <?php
            $serv = new ServController();
            $serv->ViewControllerServ();
            ?>

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>