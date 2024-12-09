
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
            
    }
?>



