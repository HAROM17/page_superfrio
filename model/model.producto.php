
<?php

class Producto extends Conectar
{

    public function getNewProducts($emp_id)
    {
        $conectar = parent::Conexion(); // Establecer conexión
        $sql = "CALL sp_l_producto_07_nuevo(?)"; // Procedimiento almacenado
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT); // Enlazar el parámetro de empresa
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retornar los resultados
    }
    
}

?>
