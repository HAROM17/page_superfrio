
<?php

class Producto extends Conectar
{

    public function getNewProducts($emp_id, $cli_id)
    {
        $conectar = parent::Conexion(); // Establecer conexión
        $sql = "CALL sp_l_producto_07_nuevo(?, ?)"; // Procedimiento almacenado
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT); // Enlazar el parámetro de empresa
        $query->bindValue(2, $cli_id, PDO::PARAM_INT); // Enlazar el parámetro de cliente
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retornar los resultados
    }
    

    public function addToWishlist($cli_id, $prod_id, $emp_id) {
        $conectar = parent::Conexion();
    
        // Verificar si el producto ya está en favoritos
        $check_sql = "SELECT COUNT(*) AS count FROM tm_favoritos WHERE cli_id = ? AND prod_id = ? AND emp_id = ?";
        $check_query = $conectar->prepare($check_sql);
        $check_query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $check_query->bindValue(2, $prod_id, PDO::PARAM_INT);
        $check_query->bindValue(3, $emp_id, PDO::PARAM_INT);
        $check_query->execute();
        $result = $check_query->fetch(PDO::FETCH_ASSOC);
    
        if ($result['count'] > 0) {
            return false; // Producto ya está en favoritos
        }
    
        // Si no está en favoritos, agregarlo
        $sql = "INSERT INTO tm_favoritos (cli_id, prod_id, emp_id, fech_crea) VALUES (?, ?, ?, NOW())";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $prod_id, PDO::PARAM_INT);
        $query->bindValue(3, $emp_id, PDO::PARAM_INT);
        return $query->execute();
    }
    


    public function removeFromWishlist($cli_id, $prod_id, $emp_id) {
        $conectar = parent::Conexion();
    
        // Eliminar el producto de favoritos
        $sql = "DELETE FROM tm_favoritos WHERE cli_id = ? AND prod_id = ? AND emp_id = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $prod_id, PDO::PARAM_INT);
        $query->bindValue(3, $emp_id, PDO::PARAM_INT);
        return $query->execute();
    }
    
    
    
}

?>
