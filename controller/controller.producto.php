<?php

class ProductoController {
    public static function ViewControllerProductoPorCategoria($empresa, $categoria) {
        // Detectar si la solicitud se realiza desde un dispositivo móvil basado en el agente de usuario
        $esDispositivoMovil = false;
        $agent = $_SERVER['HTTP_USER_AGENT'];

        $mobile_agents = array(
            'iphone',            // iPhone
            'ipod',              // iPod touch
            'android',           // Android
            'windows phone',     // Windows Phone
            'blackberry',        // BlackBerry
            'webos',             // Palm Pre/Pixi
            'opera mini',        // Opera Mini
            'mobile',            // Generic Mobile
            'kindle',            // Kindle
            'wap',               // WAP
            'midp'               // Midp - Some Mobiles
        );

        foreach ($mobile_agents as $mobile_agent) {
            if (stripos($agent, $mobile_agent) !== false) {
                $esDispositivoMovil = true;
                break;
            }
        }

        // Iniciar sesión para marcar como dispositivo móvil si es necesario
        if ($esDispositivoMovil) {
            $_SESSION['mobile'] = 'on';
        } else {
            $_SESSION['mobile'] = 'off'; // Por defecto, considerar como no móvil
        }

        // Ahora procedemos con el resto de la lógica
        $respuesta = ProductoModel::ModelProducto_X_Cat_Sab($empresa, $categoria);
        foreach ($respuesta as $item) {
            $imageUrl = Conectar::ruta_backend() . "assets/imagenes/subcategorias/" . $item["subcat_img"];

            // Determinar altura específica para diferentes tamaños de pantalla
            $alturaImagen = ($esDispositivoMovil) ? '430px' : '250px';
            echo '<div class="col-lg-3 product-item">
                    <div class="card explore-box card-animate">
                        <div class="explore-place-bid-img" style="position: relative;">
                            <img src="' . $imageUrl . '" alt="" class="card-img-top explore-img" style="width: 100%; object-fit: cover; height: ' . $alturaImagen . ';" />
                            <div class="bg-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-1">'.$item["subcat_nom"].'</a></h5>
                             <a href="view/productos/prod.php?subcat_id='.$item["subcat_id"].'" class="link-success fs-14">Comprar<i class="ri-arrow-right-line align-bottom"></i></a>
                        </div>
                    </div>
                </div>';
        }
    }
}
?>
