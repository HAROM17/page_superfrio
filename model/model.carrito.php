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


    public function addToCart($cli_id, $emp_id, $prod_id, $cantidad) {
        $conectar = parent::conexion();
    
        // Comprobar si el producto ya está en el carrito
        $sqlCheck = "SELECT cantidad FROM tm_carrito 
                     WHERE cli_id = ? AND emp_id = ? AND prod_id = ?";
        $queryCheck = $conectar->prepare($sqlCheck);
        $queryCheck->bindValue(1, $cli_id, PDO::PARAM_INT);
        $queryCheck->bindValue(2, $emp_id, PDO::PARAM_INT);
        $queryCheck->bindValue(3, $prod_id, PDO::PARAM_INT);
        $queryCheck->execute();
        $existingCartItem = $queryCheck->fetch(PDO::FETCH_ASSOC);
    
        if ($existingCartItem) {
            // Si ya existe, actualizar la cantidad
            $sqlUpdate = "UPDATE tm_carrito SET cantidad = cantidad + ? 
                          WHERE cli_id = ? AND emp_id = ? AND prod_id = ?";
            $queryUpdate = $conectar->prepare($sqlUpdate);
            $queryUpdate->bindValue(1, $cantidad, PDO::PARAM_INT);
            $queryUpdate->bindValue(2, $cli_id, PDO::PARAM_INT);
            $queryUpdate->bindValue(3, $emp_id, PDO::PARAM_INT);
            $queryUpdate->bindValue(4, $prod_id, PDO::PARAM_INT);
            $queryUpdate->execute();
        } else {
            // Si no existe, insertar un nuevo registro
            $sqlInsert = "INSERT INTO tm_carrito (cli_id, emp_id, prod_id, cantidad) 
                          VALUES (?, ?, ?, ?)";
            $queryInsert = $conectar->prepare($sqlInsert);
            $queryInsert->bindValue(1, $cli_id, PDO::PARAM_INT);
            $queryInsert->bindValue(2, $emp_id, PDO::PARAM_INT);
            $queryInsert->bindValue(3, $prod_id, PDO::PARAM_INT);
            $queryInsert->bindValue(4, $cantidad, PDO::PARAM_INT);
            $queryInsert->execute();
        }
    
        return true; // Indicar éxito
    }


    public function getCartItems($cli_id, $emp_id) {
        $conectar = parent::conexion();
        $sql = "SELECT 
                c.carrito_id, 
                p.prod_id, 
                p.prod_nom, 
                p.prod_precio, 
                p.prod_img, 
                c.cantidad, 
                cat.cat_nom AS category_name,
                subcat.subcat_nom AS subcategory_name, 
                s.sab_nom AS flavor_name
            FROM tm_carrito c
            JOIN tm_producto p ON c.prod_id = p.prod_id
            LEFT JOIN tm_categoria cat ON p.cat_id = cat.cat_id
            LEFT JOIN tm_subcategoria subcat ON p.subcat_id = subcat.subcat_id
            LEFT JOIN tm_sabor s ON p.sab_id = s.sab_id
            WHERE c.cli_id = ? AND c.emp_id = ? AND c.est = 1;
        ";
    
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $emp_id, PDO::PARAM_INT);
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function removeFromCart($carrito_id) {
        $conectar = parent::Conexion();
        $sql = "DELETE FROM tm_carrito WHERE carrito_id = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $carrito_id, PDO::PARAM_INT);
        return $query->execute();
    }


    public function updateCartItems($items, $cli_id, $emp_id) {
        $conectar = parent::conexion();
        $conectar->beginTransaction(); // Inicia una transacción
    
        try {
            foreach ($items as $item) {
                $sql = "UPDATE tm_carrito 
                        SET cantidad = ? 
                        WHERE carrito_id = ? AND cli_id = ? AND emp_id = ?";
                $query = $conectar->prepare($sql);
                $query->bindValue(1, $item['cantidad'], PDO::PARAM_INT); // Nueva cantidad
                $query->bindValue(2, $item['carrito_id'], PDO::PARAM_INT); // ID del carrito
                $query->bindValue(3, $cli_id, PDO::PARAM_INT); // ID del cliente desde la sesión
                $query->bindValue(4, $emp_id, PDO::PARAM_INT); // ID de la empresa desde la sesión
                $query->execute();
            }
    
            $conectar->commit(); // Confirma los cambios
            return ["success" => true];
        } catch (Exception $e) {
            $conectar->rollBack(); // Revertir cambios en caso de error
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
    
    
    
    
    
}

?>
