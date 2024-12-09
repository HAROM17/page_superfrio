
    <?php
    // Llamando Clases
    require_once("../config/conexion.php");
    require_once("../model/model.producto.php");

    ///Inicializando clase
    $producto = new Producto();

    switch ($_GET["op"]) {

        case 'l_nuevos_productos':
            session_start();
            $emp_id = $_POST['emp_id'];
            $cli_id = isset($_SESSION['cli_id']) ? $_SESSION['cli_id'] : null; // Obtener el ID del cliente si está autenticado
        
            $products = $producto->getNewProducts($emp_id, $cli_id); // Llamar al modelo con ambos parámetros
            $ruta_base = Conectar::ruta_back(); // Obtener la ruta base
        
            echo json_encode([
                'ruta_base' => $ruta_base,
                'products' => $products,
            ]);
            break;
        

        case 'add_to_wishlist':
            session_start();
            if (isset($_SESSION['cli_id'])) {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
                $prod_id = $_POST['prod_id'];
        
                $result = $producto->addToWishlist($cli_id, $prod_id, $emp_id);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Producto añadido a favoritos.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'El producto ya está en favoritos.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
            }
            break;
            

        case 'remove_from_wishlist':
            session_start();
            if (isset($_SESSION['cli_id'])) {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
                $prod_id = $_POST['prod_id'];
                
                $result = $producto->removeFromWishlist($cli_id, $prod_id, $emp_id);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Producto eliminado de favoritos.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto de favoritos.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
            }
            break;
            
            
    }
?>



