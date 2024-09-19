<?php

class ContactoController {
    public static function ViewContactoController() {
        $respuesta = ContactoModel::ModelContacto("tm_empresa");

		foreach ($respuesta as $item){

			echo '<div class="col-lg-4">
                        <div>
                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">DIRECCIÓN:</h5>
                                <div class="ff-secondary fw-semibold">'.$item["emp_direc"].'</div>
                            </div>
                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">RUC:</h5>
                                <div class="ff-secondary fw-semibold">'.$item["emp_ruc"].'</div>
                            </div>

                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">TELEFONO:</h5>
                                <div class="ff-secondary fw-semibold">'.$item["emp_telef"].'</div>
                            </div>
                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">CORREO:</h5>
                                <div class="ff-secondary fw-semibold">'.$item["emp_correo"].'</div>
                            </div>

                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">HORA DE ATENCIÓN:</h5>
                                <div class="ff-secondary fw-semibold">6:00am a 4:00pm</div>
                            </div>
                        </div>
                    </div>';

		}

    }
}
