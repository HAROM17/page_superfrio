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
                $emp_id = $_SESSION['emp_id'];
    
                $cartCount = $carrito->getCartCount($cli_id, $emp_id);
                echo json_encode(['success' => true, 'count' => $cartCount]);
            } else {
                echo json_encode(['success' => false, 'count' => 0]);
            }
            break;

        case 'add_to_cart':
            session_start();
        
            if (isset($_POST['prod_id'], $_POST['cantidad'])) {
                $prod_id = $_POST['prod_id'];
                $cantidad = $_POST['cantidad'];
                $cli_id = isset($_SESSION['cli_id']) ? $_SESSION['cli_id'] : null;
                $emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : 1; // Ajusta según tu lógica empresarial
        
                if ($cli_id && $emp_id) {
                    $result = $carrito->addToCart($cli_id, $emp_id, $prod_id, $cantidad);
        
                    if ($result) {
                        echo json_encode([
                            'success' => true,
                            'message' => 'Producto agregado al carrito correctamente.'
                        ]);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'No se pudo agregar el producto al carrito.'
                        ]);
                    }
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Usuario no autenticado.'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Faltan parámetros necesarios.'
                ]);
            }
            break;
            
        case 'get_cart_items':
            session_start();
            if (isset($_SESSION['cli_id']) && isset($_SESSION['emp_id'])) {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
                $cartItems = $carrito->getCartItems($cli_id, $emp_id);
                $ruta_base = Conectar::ruta_back();
                echo json_encode([
                    'ruta_base' => $ruta_base,
                    'success' => true,
                    'items' => $cartItems
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Usuario no autenticado o sesión expirada.'
                ]);
            }
            break;

        case 'remove_from_cart':
            if (isset($_POST['carrito_id'])) {
                $carrito_id = $_POST['carrito_id'];
                $result = $carrito->removeFromCart($carrito_id);
                echo json_encode(['success' => $result]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Faltan parámetros.']);
            }
            break;
            
            
    }
?>



