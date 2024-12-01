<?php

class Cliente extends Conectar {

    /* Método para validar el inicio de sesión */
    public function loginCliente($correo, $pass, $emp_id) {
        $conectar = parent::Conexion();
        $sql = "CALL login_cliente(?, ?, ?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->bindValue(2, $correo, PDO::PARAM_STR);
        $query->bindValue(3, $pass, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    

    public function get_cliente_x_correo($cli_correo, $emp_id) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT 
                    tm_cliente.cli_id, 
                    tm_cliente.emp_id, 
                    tm_cliente.cli_nom, 
                    tm_cliente.cli_ape, 
                    tm_cliente.cli_correo, 
                    tm_cliente.cli_telf, 
                    tm_cliente.cli_img, 
                    tm_cliente.cli_direc,
                    tm_empresa.emp_nom
                FROM 
                    tm_cliente
                INNER JOIN 
                    tm_empresa ON tm_cliente.emp_id = tm_empresa.emp_id
                WHERE 
                    tm_cliente.cli_correo = ? 
                    AND tm_cliente.emp_id = ? 
                    AND tm_cliente.est = 1";
    
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_correo);
        $query->bindValue(2, $emp_id);
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insert_cliente($nombre, $apellido, $correo, $password) {
        $conectar = parent::Conexion();
        $sql = "INSERT INTO tm_cliente (cli_nom, cli_ape, cli_correo, cli_pass, emp_id, fech_crea, est) 
                VALUES (?, ?, ?, ?, 1, NOW(), 1)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $nombre);
        $query->bindValue(2, $apellido);
        $query->bindValue(3, $correo);
        $query->bindValue(4, $password);
        return $query->execute();
    }
    

    
    public function insert_cliente_google($nombre, $apellido, $correo, $foto, $emp_id) {
        $conectar = parent::Conexion();
        $sql = "INSERT INTO tm_cliente (cli_nom, cli_ape, cli_correo, cli_img, emp_id, fech_crea, est) 
                VALUES (?, ?, ?, ?, ?, NOW(), 1)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $nombre);
        $query->bindValue(2, $apellido);
        $query->bindValue(3, $correo);
        $query->bindValue(4, $foto);
        $query->bindValue(5, $emp_id);
        return $query->execute();
    }


    public function guardarImagenDesdeUrlLocal($url) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Obtener la extensión de la imagen
            $extension = pathinfo($url, PATHINFO_EXTENSION);
            $extension = $extension ?: 'png'; // Si no tiene extensión, usar PNG por defecto
    
            // Generar un nombre único para la imagen
            $new_name = time() . rand(1000, 9999) . '.' . $extension;
    
            // Definir la ruta donde se guardará la imagen (en otro proyecto)
            $destination = "C:/xampp/htdocs/sistema_tropical/assets/imagenes/clientes/" . $new_name;
    
            // Descargar la imagen desde la URL
            $imagen = file_get_contents($url);
            if ($imagen === false) {
                return false; // Error al descargar la imagen
            }
    
            // Guardar la imagen en el destino
            if (file_put_contents($destination, $imagen) !== false) {
                return $new_name; // Retorna solo el nombre del archivo
            }
        }
        return false; // Retorna false si falla
    }
    




    public function guardarImagenDesdeUrlHosting($url) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Generar un nombre único para la imagen
            $extension = pathinfo($url, PATHINFO_EXTENSION) ?: 'png';
            $new_name = time() . rand(1000, 9999) . '.' . $extension;
    
            // Definir la URL del backend para subir la imagen
            $uploadEndpoint = "https://sistema.haromdev.com/api/subir_imagen_cliente.php";
    
            // Enviar la imagen al backend
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $uploadEndpoint);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'image_url' => $url,
                'image_name' => $new_name,
            ]);
    
            $response = curl_exec($ch);
            curl_close($ch);
    
            $result = json_decode($response, true);
    
            if ($result && $result['success']) {
                return $new_name; // Retornar solo el nombre de la imagen
            }
        }
    
        return false; // Retorna false si falla
    }
    
    
    
    
}

?>
