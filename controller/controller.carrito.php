<?php
    // Llamando Clases
    require_once("../config/conexion.php");
    require_once("../model/model.carrito.php");

    ///Inicializando clase
    $carrito = new Carrito();

    switch ($_GET["op"]) {

        case 'get_cart_count':
            session_start();
            if (isset($_SESSION['cli_id'])) {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id']; // Suponiendo que también tienes el ID de la empresa
    
                $cartCount = $carrito->getCartCount($cli_id, $emp_id);
                echo json_encode(['success' => true, 'count' => $cartCount]);
            } else {
                echo json_encode(['success' => false, 'count' => 0]);
            }
            break;
            
    }
?>



