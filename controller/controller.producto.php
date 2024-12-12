
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
            

        case 'l_all_productos':
        session_start();
        $emp_id = $_POST['emp_id'];
        $cli_id = isset($_SESSION['cli_id']) ? $_SESSION['cli_id'] : null; // Obtener el ID del cliente si está autenticado
    
        $products = $producto->GetProductsAll($emp_id, $cli_id); // Llamar al modelo con ambos parámetros
        $ruta_base = Conectar::ruta_back(); // Obtener la ruta base
    
        echo json_encode([
            'ruta_base' => $ruta_base,
            'products' => $products,
        ]);
        break;
            
            
        case 'get_product_details':
            session_start();
            if (isset($_POST['prod_id']) && isset($_POST['emp_id'])) {
                $prod_id = $_POST['prod_id'];
                $emp_id = $_POST['emp_id'];
        
                $productDetails = $producto->getProductDetails($prod_id, $emp_id); // Llamada al modelo
                $ruta_base = Conectar::ruta_back();
                if ($productDetails) {
                    echo json_encode([
                        'success' => true,
                        'ruta_base' => $ruta_base,
                        'product' => $productDetails
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'No se encontraron detalles para el producto especificado.'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Faltan parámetros necesarios.'
                ]);
            }
            break;
            

        case 'get_subcategories_with_flavor_count':
            $emp_id = $_POST['emp_id']; // ID de la empresa
            $result = $producto->getSubcategoriesWithFlavorCount($emp_id);
        
            if ($result) {
                echo json_encode([
                    'success' => true,
                    'subcategories' => $result
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'No se encontraron subcategorías.'
                ]);
            }
            break;


        case 'get_products_by_subcategory':
            session_start();
            $emp_id = $_POST['emp_id'];
            $subcat_id = $_POST['subcat_id'];
            $cli_id = isset($_SESSION['cli_id']) ? $_SESSION['cli_id'] : null;
        
            $products = $producto->getProductsBySubcategory($emp_id, $subcat_id, $cli_id);
            $ruta_base = Conectar::ruta_back();
            echo json_encode([
                'success' => true,
                'ruta_base' => $ruta_base,
                'products' => $products,
            ]);
            break;
    }
?>



