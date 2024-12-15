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
                // Validar sesión
                if (!isset($_SESSION['cli_id']) || !isset($_SESSION['emp_id'])) {
                    echo json_encode(["success" => false, "message" => "Sesión no válida. Por favor, inicie sesión."]);
                    exit;
                }
        
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
        
                // Validar datos del cliente
                $nombres = $_POST['nombres'] ?? '';
                $apellidos = $_POST['apellidos'] ?? '';
                $dni = $_POST['dni'] ?? '';
                $telefono = $_POST['telefono'] ?? '';
                $direccion = $_POST['direccion'] ?? '';
        
                if (empty($nombres) || empty($apellidos) || empty($dni) || empty($telefono) || empty($direccion)) {
                    echo json_encode(["success" => false, "message" => "Todos los datos del cliente son obligatorios."]);
                    exit;
                }
        
                // Obtener datos actuales del cliente y verificar cambios
                $clienteActual = $pedido->obtenerClientePorId($cli_id, $emp_id);
                if (!$clienteActual) {
                    echo json_encode(["success" => false, "message" => "No se encontró el cliente."]);
                    exit;
                }
        
                $hayCambios = (
                    $clienteActual['cli_nom'] !== $nombres ||
                    $clienteActual['cli_ape'] !== $apellidos ||
                    $clienteActual['cli_dni'] !== $dni ||
                    $clienteActual['cli_telf'] !== $telefono ||
                    $clienteActual['cli_direc'] !== $direccion
                );
        
                if ($hayCambios) {
                    $actualizado = $pedido->actualizarCliente($cli_id, $emp_id, $nombres, $apellidos, $dni, $telefono, $direccion);
                    if (!$actualizado) {
                        echo json_encode(["success" => false, "message" => "No se pudo actualizar los datos del cliente."]);
                        exit;
                    }
                }
        
                // Validar carrito
                if (empty($_POST['carrito'])) {
                    echo json_encode(["success" => false, "message" => "El carrito está vacío o no se envió correctamente."]);
                    exit;
                }
        
                $carrito = json_decode($_POST['carrito'], true);
                if (!is_array($carrito) || count($carrito) === 0) {
                    echo json_encode(["success" => false, "message" => "El carrito está vacío o tiene un formato incorrecto."]);
                    exit;
                }
        
                // Validar que el carrito tenga al menos 80 productos
                $cantidadTotal = array_sum(array_column($carrito, 'cantidad'));
                if ($cantidadTotal < 80) {
                    echo json_encode(["success" => false, "message" => "Debe tener al menos 80 productos en el carrito para realizar el pedido."]);
                    exit;
                }
        
                // Validar pag_id
                if (empty($_POST['pag_id'])) {
                    echo json_encode(["success" => false, "message" => "El método de pago no fue seleccionado correctamente."]);
                    exit;
                }
        
                $pag_id = intval($_POST['pag_id']); // Aseguramos que sea un entero válido.
                $voucher = null;
        
                if ($pag_id === 3) { // Tarjeta seleccionada
                    $voucher = strtoupper(bin2hex(random_bytes(6))); // Generar un código aleatorio
                } elseif ($pag_id === 2) { // Yape seleccionado
                    if (!isset($_FILES['voucher']) || $_FILES['voucher']['error'] !== UPLOAD_ERR_OK) {
                        echo json_encode(["success" => false, "message" => "El comprobante de pago es obligatorio para Yape."]);
                        exit;
                    }
                    $voucher = $_FILES['voucher'];
                } else {
                    echo json_encode(["success" => false, "message" => "Método de pago no válido."]);
                    exit;
                }
        
                // Crear pedido y manejar excepciones
                try {
                    $result = $pedido->crearPedido($cli_id, $emp_id, $carrito, $voucher, $pag_id);
        
                    if ($result['success']) {
                        echo json_encode(["success" => true, "message" => "Pedido creado correctamente y carrito vaciado."]);
                    } else {
                        echo json_encode(["success" => false, "message" => $result['message']]);
                    }
                } catch (Exception $e) {
                    echo json_encode(["success" => false, "message" => "Error al procesar el pedido: " . $e->getMessage()]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Método no permitido."]);
            }
            break;
        
    }
?>

