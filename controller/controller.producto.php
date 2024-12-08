
    <?php
    // Llamando Clases
    require_once("../config/conexion.php");
    require_once("../model/model.producto.php");

    ///Inicializando clase
    $producto = new Producto();

    switch ($_GET["op"]) {

        case 'l_nuevos_productos':
            $emp_id = $_POST['emp_id'];
            $products = $producto->getNewProducts($emp_id);
            $ruta_base = Conectar::ruta_back(); // Obtiene la ruta base
        
            echo json_encode([
                'ruta_base' => $ruta_base,
                'products' => $products,
            ]);
            break;
        
    }
    ?>



