<?php

class GaleriaController
{
    public static function ViewControllerGaleriaIMG()
    {
        $respuesta = GaleriaModel::ModelGaleriaIMG("tm_galeria");

        // Encabezado de Swiper
        echo '<div class="text-center mb-5">
                <h4 class="mb-3 fw-semibold"><span class="text-success">IMAGENES</span></h4>
            </div>
            <div class="swiper effect-coverflow-swiper rounded pb-5 swiper-coverflow swiper-3d swiper-initialized swiper-horizontal swiper-pointer-events">
                <div class="swiper-wrapper" id="swiper-wrapper-1110212e5173102e2e" aria-live="off">';

        foreach ($respuesta as $index => $item) {
            $imageUrl = Conectar::ruta_backend() . "assets/galeria/" . $item["gale_ruta"];
            $zIndex = -7 + ($index * 2);
            $rotation = 400 - ($index * 50);
            echo '<div class="swiper-slide" data-swiper-slide-index="' . $index . '" role="group" aria-label="' . ($index + 1) . ' / ' . count($respuesta) . '" style="width: 143.25px; transition-duration: 0ms; transform: translate3d(0px, 0px, ' . $zIndex . 'px) rotateX(0deg) rotateY(' . $rotation . 'deg) scale(1); z-index: ' . $zIndex . ';">
                    <img src="' . $imageUrl . '" alt="" class="img-fluid">
                    <div class="swiper-slide-shadow-left" style="opacity: ' . abs($zIndex) . '; transition-duration: 0ms;"></div>
                    <div class="swiper-slide-shadow-right" style="opacity: ' . (10 - abs($zIndex)) . '; transition-duration: 0ms;"></div>
                  </div>';
        }
        // Pie de página de Swiper
        echo '  </div>
                <div class="swiper-pagination swiper-pagination-dark swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic" style="width: 150px;">
                    <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1" style="left: -60px;"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2" style="left: -60px;"></span>
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active-prev-prev" tabindex="0" role="button" aria-label="Go to slide 3" style="left: -60px;"></span>
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active-prev" tabindex="0" role="button" aria-label="Go to slide 4" style="left: -60px;"></span>
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" tabindex="0" role="button" aria-label="Go to slide 5" aria-current="true" style="left: -60px;"></span>
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active-next" tabindex="0" role="button" aria-label="Go to slide 6" style="left: -60px;"></span>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>';
    }


    public static function ViewControllerGaleriaMV()
    {
        $respuesta = GaleriaModel::ModelGaleriaMV("tm_galeria");

        // Start echoing the static part of HTML
        echo '<div class="text-center mb-5">
            <h4 class="mb-3 fw-semibold"><span class="text-danger">VIDEOS</span></h4>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="row gallery-wrapper" id="galeria_container">';

        // Iterate through each $respuesta item to generate video elements
        foreach ($respuesta as $item) {
            $videoUrl = Conectar::ruta_backend() . "assets/galeria/" . $item["gale_ruta"];

            echo '<div class="element-item col-lg-4 col-md-3 col-sm-6 col-xs-12 videos gallery-item" data-category="videos">
                <div class="gallery-box card">
                  <div class="gallery-container">
                    <video controls="" width="100%">
                      <source src="' . htmlspecialchars($videoUrl) . '" type="video/mp4">
                    </video>
                  </div>
                </div>
              </div>';
        }

        // Close the remaining HTML tags
        echo '</div>
          </div>
        </div>';
    }
}
