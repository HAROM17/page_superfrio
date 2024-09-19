<?php

class SlideController {
    public static function ViewControllerSlide() {
        $respuesta = SlideModel::ModelSlide("tm_slide");
        $first = true; // Variable para controlar el primer elemento
        foreach ($respuesta as $item) {
            $imageUrl = Conectar::ruta_backend() . "assets/imagenes/slides/" . $item["sli_img"];
            $activeClass = $first ? ' active' : '';
            echo '<div class="carousel-item' . $activeClass . '">
                    <img class="d-block img-fluid mx-auto" src="' . $imageUrl . '" alt="Slide image">
                </div>';
            $first = false;
        }

    }
}
