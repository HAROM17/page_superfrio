
<?php

class Producto extends Conectar
{

    public function getNewProducts($emp_id, $cli_id)
    {
        $conectar = parent::Conexion();
        $sql = "CALL sp_l_producto_07_nuevo(?, ?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->bindValue(2, $cli_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetProductsAll($emp_id, $cli_id)
    {
        $conectar = parent::Conexion();
        $sql = "CALL sp_l_producto_08_all(?, ?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->bindValue(2, $cli_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductDetails($prod_id, $emp_id)
    {
        $conectar = parent::conexion();

        $sql = "SELECT 
                    p.prod_id,
                    p.prod_nom,
                    p.prod_precio,
                    p.prod_img,
                    p.prod_stock,
                    p.prod_descrip,
                    c.cat_nom AS category,
                    s.sab_nom AS flavor,
                    sm.subcat_nom AS sub_brand
                FROM 
                    tm_producto p
                LEFT JOIN 
                    tm_categoria c ON p.cat_id = c.cat_id
                LEFT JOIN 
                    tm_sabor s ON p.sab_id = s.sab_id
                LEFT JOIN 
                    tm_subcategoria sm ON p.subcat_id = sm.subcat_id
                WHERE 
                    p.prod_id = ? AND p.emp_id = ?";

        $query = $conectar->prepare($sql);
        $query->bindValue(1, $prod_id, PDO::PARAM_INT);
        $query->bindValue(2, $emp_id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function getSubcategoriesWithFlavorCount($emp_id)
    {
        $conectar = parent::conexion();
        $sql = "SELECT 
                    sm.subcat_id,
                    sm.subcat_nom AS subcategory_name,
                    sm.subcat_img AS subcategory_image,
                    COUNT(s.sab_id) AS flavor_count
                FROM tm_subcategoria sm
                LEFT JOIN tm_producto p ON sm.subcat_id = p.subcat_id
                LEFT JOIN tm_sabor s ON p.sab_id = s.sab_id
                WHERE sm.emp_id = ? AND sm.est = 1
                GROUP BY sm.subcat_id";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsBySubcategory($emp_id, $subcat_id, $cli_id = null)
    {
        $conectar = parent::conexion();
        $sql = " SELECT 
            p.prod_id,          
            p.prod_nom,         
            p.prod_precio,      
            p.prod_img,         
            c.cat_nom AS categoria, 
            s.sab_nom AS sabor,  
            sm.subcat_nom AS sub_marca, 
            CASE
                WHEN f.cli_id IS NOT NULL THEN 1 
                ELSE 0
            END AS is_favorited
        FROM 
            tm_producto p
        LEFT JOIN 
            tm_categoria c ON p.cat_id = c.cat_id  
        LEFT JOIN 
            tm_sabor s ON p.sab_id = s.sab_id 
        LEFT JOIN 
            tm_subcategoria sm ON p.subcat_id = sm.subcat_id 
        LEFT JOIN 
            tm_favoritos f ON p.prod_id = f.prod_id AND f.cli_id = IFNULL(?, 0) AND f.emp_id = ?
        WHERE 
            p.subcat_id = ? 
            AND p.est = 1   
            AND p.emp_id = ? 
            AND (p.prod_img IS NOT NULL AND p.prod_img <> '')
        ORDER BY 
            p.fech_crea DESC; 
    ";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $emp_id, PDO::PARAM_INT);
        $query->bindValue(3, $subcat_id, PDO::PARAM_INT);
        $query->bindValue(4, $emp_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProductsByCategory($emp_id, $cat_id, $cli_id = null)
    {
        $conectar = parent::conexion();
        $sql = " SELECT 
            p.prod_id,          
            p.prod_nom,         
            p.prod_precio,      
            p.prod_img,         
            c.cat_nom AS categoria, 
            s.sab_nom AS sabor,  
            sm.subcat_nom AS sub_marca, 
            CASE
                WHEN f.cli_id IS NOT NULL THEN 1 
                ELSE 0
            END AS is_favorited
        FROM 
            tm_producto p
        LEFT JOIN 
            tm_categoria c ON p.cat_id = c.cat_id  
        LEFT JOIN 
            tm_sabor s ON p.sab_id = s.sab_id 
        LEFT JOIN 
            tm_subcategoria sm ON p.subcat_id = sm.subcat_id 
        LEFT JOIN 
            tm_favoritos f ON p.prod_id = f.prod_id AND f.cli_id = IFNULL(?, 0) AND f.emp_id = ?
        WHERE 
            p.cat_id = ? 
            AND p.est = 1   
            AND p.emp_id = ? 
            AND (p.prod_img IS NOT NULL AND p.prod_img <> '')
        ORDER BY 
            p.fech_crea DESC; 
    ";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $emp_id, PDO::PARAM_INT);
        $query->bindValue(3, $cat_id, PDO::PARAM_INT);
        $query->bindValue(4, $emp_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCategoriasConSubcategorias($emp_id) {
        $conectar = parent::Conexion();
        $sql = "SELECT 
                    c.cat_id AS categoria_id,
                    c.cat_nom AS categoria_nombre,
                    sc.subcat_id AS subcategoria_id,
                    sc.subcat_nom AS subcategoria_nombre
                FROM tm_categoria c
                LEFT JOIN tm_subcategoria sc 
                    ON c.cat_id = sc.cat_id AND sc.est = 1
                WHERE c.emp_id = ? AND c.est = 1
                ORDER BY c.cat_nom, sc.subcat_nom";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $categorias = [];
        foreach ($results as $row) {
            $cat_id = $row['categoria_id'];
            if (!isset($categorias[$cat_id])) {
                $categorias[$cat_id] = [
                    'categoria_nombre' => $row['categoria_nombre'],
                    'categoria_id' => $row['categoria_id'],
                    'subcategorias' => []
                ];
            }
            if ($row['subcategoria_id']) {
                $categorias[$cat_id]['subcategorias'][] = [
                    'subcategoria_id' => $row['subcategoria_id'],
                    'subcategoria_nombre' => $row['subcategoria_nombre']
                ];
            }
        }
    
        return array_values($categorias); // Devolver como un array indexado
    }
    
    
    
    
    
}

?>
