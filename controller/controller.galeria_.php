<?php
require_once("../config/conexion.php");
require_once("../model/model.galeria_.php");

$galeria = new Galeria();

switch($_GET["op"]) {
    /* Listar elementos de la galería por empresa */
        case "listar":
            $datos = $galeria->get_galeria_x_emp_id($_POST["emp_id"]);
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $iv_url = Conectar::ruta_backend() . "assets/galeria/" . $row["gale_ruta"];
                if ($row["gale_tipo"] == 'foto') {
                    $sub_array[] =
                        "<div class='element-item col-xxl-3 col-xl-3 col-sm-6 fotos  ' data-category='fotos'>".
                            "<div class='gallery-box card'>".
                                "<div class='gallery-container'>".
                                    "<a class='image-popup' href='" . $iv_url . "' title=''>".
                                        "<img class='gallery-img img-fluid mx-auto' src='" . $iv_url . "' alt='' />".
                                    "</a>".
                                    "<br>".
                                "</div>".
                            "</div>".
                        "</div>";
                } elseif ($row["gale_tipo"] == 'video') {
                    $sub_array[] =
                        "<div class='element-item col-lg-4 col-md-3 col-sm-6 col-xs-12  videos' data-category=' videos'>".
                            "<div class='gallery-box card'>".
                                "<div class='gallery-container'>".
                                        "<video controls width='100%'>".
                                            "<source src='" . $iv_url . "' type='video/mp4'>".
                                        "</video>".
                                    "</a>".
                                "</div>".
                            "</div>".
                        "</div>";
                }
                $sub_array[] = date("d/m/Y h:i A", strtotime($row["fech_crea"]));
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
            break;

}
?>
