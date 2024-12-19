
<?php

class Empresa extends Conectar {


    
    public function obtenerInfoEmpresa($emp_id)
    {
        $conectar = parent::conexion();
        $sql = "SELECT emp_nom, emp_ruc, emp_logo, emp_correo, emp_telef, emp_direc, fech_crea, est 
                FROM tm_empresa 
                WHERE emp_id = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result : null; // Retorna toda la información o null si no existe
    }
    
    
    
}

?>
