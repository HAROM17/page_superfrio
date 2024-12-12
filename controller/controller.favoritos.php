
    <?php
    // Llamando Clases
    require_once("../config/conexion.php");
    require_once("../model/model.favoritos.php");

    ///Inicializando clase
    $favoritos = new Favoritos();

    switch ($_GET["op"]) {

        case 'get_favorites_count':
            session_start();
            if (isset($_SESSION['cli_id'])) {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
        
                $favoritesCount = $favoritos->getFavoritesCount($cli_id, $emp_id);
                echo json_encode(['success' => true, 'count' => $favoritesCount]);
            } else {
                echo json_encode(['success' => false, 'count' => 0]);
            }
            break;   
            
            
        case 'agregar_favoritos':
            session_start();
            if (isset($_SESSION['cli_id'])) {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
                $prod_id = $_POST['prod_id'];
        
                $result = $favoritos->agregar_favoritos($cli_id, $prod_id, $emp_id);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Producto añadido a favoritos.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'El producto ya está en favoritos.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
            }
            break;
            

        case 'eliminar_favoritos':
            session_start();
            if (isset($_SESSION['cli_id'])) {
                $cli_id = $_SESSION['cli_id'];
                $emp_id = $_SESSION['emp_id'];
                $prod_id = $_POST['prod_id'];
                
                $result = $favoritos->eliminar_favoritos($cli_id, $prod_id, $emp_id);
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



