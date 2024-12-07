<?php

class Carrito extends Conectar {

    public function getCartCount($cli_id, $emp_id) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT SUM(cantidad) AS total_cantidad 
                FROM tm_carrito 
                WHERE cli_id = ? AND emp_id = ? AND est = 1";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id);
        $query->bindValue(2, $emp_id);
        $query->execute();
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total_cantidad'] ?? 0; // Retorna 0 si no hay productos
    }
}

?>
