<?php
    // Llamando Clases
    require_once("../config/conexion.php");
    require_once("../model/model.pedido.php");

    ///Inicializando clase
    $pedido = new Pedido();

    switch ($_GET["op"]) {

        case 'crear_pedido':
            session_start();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
                $carrito = json_decode($_POST['carrito'], true);
                $voucher = $_FILES['voucher'];
        
                $pedidoModel = new Pedido();
                $result = $pedidoModel->crearPedido($cli_id, $emp_id, $carrito, $voucher);
        
                echo json_encode($result);
            } else {
                echo json_encode(["success" => false, "message" => "Método no permitido."]);
            }
            break;
                       
    }
?>

