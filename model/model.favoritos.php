


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
}

?>
