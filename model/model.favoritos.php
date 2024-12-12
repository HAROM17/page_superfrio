
<?php

class Favoritos extends Conectar {

    public function getFavoritesCount($cli_id, $emp_id) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT COUNT(*) AS total 
                FROM tm_favoritos 
                WHERE cli_id = ? AND emp_id = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $emp_id, PDO::PARAM_INT);
        $query->execute();
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function agregar_favoritos($cli_id, $prod_id, $emp_id) {
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


    public function eliminar_favoritos($cli_id, $prod_id, $emp_id) {
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
