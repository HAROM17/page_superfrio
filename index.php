<?php 
    // Incluyendo archivos necesarios
    require_once("config/conexion.php");

    require_once("model/model.slide.php");
    require_once("model/model.servicio.php");
    require_once("model/model.producto.php");
    require_once("model/model.contacto.php");
    require_once("model/model.galeria.php");

    require_once("controller/controller.slide.php");
    require_once("controller/controller.servicio.php");
    require_once("controller/controller.producto.php");
    require_once("controller/controller.contacto.php");
    require_once("controller/controller.galeria.php");

    require_once("controller/controller.pagina.php");

    // Creando una instancia del controlador de páginas
    $pagina = new pagina_controller();
    $pagina->pagina();
?>
