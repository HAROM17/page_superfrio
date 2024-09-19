<?php

class ServController{

	public static function ViewControllerServ(){

		$respuesta = ServModel::ModModelServ("tm_servicio");

		foreach ($respuesta as $item){

			echo '
            <div class="col-lg-4">
                <div class="d-flex p-3">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-sm icon-effect">
                            <div class="avatar-title bg-transparent text-success rounded-circle">
                                '.$item["serv_icon"].'
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fs-18">'.$item["serv_titulo"].'</h5>
                        <p class="text-muted my-3 ff-secondary">'.$item["serv_descrip"].'</p>
                    </div>
                </div>
            </div>    ';

		}

	}
}
