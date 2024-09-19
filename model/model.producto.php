<?php

require_once "config/conexion.php";

class ProductoModel {
    public static function ModelProducto_X_Cat_Sab($empresa, $categoria) {
        $stmt = Conectar::Conexion()->prepare("CALL mostrar_marcas(:empresa, :categoria)");
        $stmt->bindParam(':empresa', $empresa, PDO::PARAM_INT);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->closeCursor();
    }
}
?>
