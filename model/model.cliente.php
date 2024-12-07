<?php

class Cliente extends Conectar {


    /* Método para validar el inicio de sesión */
    public function loginCliente($cli_Correo, $cli_pass, $emp_id) {
        $conectar = parent::Conexion();
        $sql = "CALL sp_l_cliente_03(?, ?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->bindValue(2, $cli_Correo, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Validar si el cliente existe y la contraseña es válida
        if ($result && password_verify($cli_pass, $result['cli_pass'])) {
            // Eliminar el hash de la contraseña antes de retornar los datos
            unset($result['cli_pass']);
            return $result; // Retorna los datos del cliente si es válido
        }

        return false; // Retorna false si el cliente no existe o la contraseña no es válida
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


    public function insert_cliente($cli_nom, $cli_ape, $cli_dni, $cli_correo, $cli_pass) {
        $conectar = parent::Conexion();
        $hashed_password = password_hash($cli_pass, PASSWORD_BCRYPT);
        $sql = "INSERT INTO tm_cliente (cli_nom, cli_ape,cli_dni, cli_correo, cli_pass, emp_id, fech_crea, est) 
                VALUES (?, ?, ?, ?, ?, 1, NOW(), 1)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_nom);
        $query->bindValue(2, $cli_ape);
        $query->bindValue(3, $cli_dni);
        $query->bindValue(4, $cli_correo);
        $query->bindValue(5, $hashed_password);
        return $query->execute();
    }
    
    
    public function insert_cliente_google($cli_nom, $cli_ape, $cli_correo, $cli_img, $emp_id) {
        $conectar = parent::Conexion();
        $sql = "INSERT INTO tm_cliente (cli_nom, cli_ape, cli_correo, cli_img, emp_id, fech_crea, est) 
                VALUES (?, ?, ?, ?, ?, NOW(), 1)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_nom);
        $query->bindValue(2, $cli_ape);
        $query->bindValue(3, $cli_correo);
        $query->bindValue(4, $cli_img);
        $query->bindValue(5, $emp_id);
        return $query->execute();
    }


    public function guardarImagenDesdeUrlLocal($cli_img) {
        if (filter_var($cli_img, FILTER_VALIDATE_URL)) {
            // Obtener la extensión de la imagen
            $extension = pathinfo($cli_img, PATHINFO_EXTENSION);
            $extension = $extension ?: 'png'; // Si no tiene extensión, usar PNG por defecto
    
            // Generar un nombre único para la imagen
            $new_name = time() . rand(1000, 9999) . '.' . $extension;
    
            // Definir la ruta donde se guardará la imagen (en otro proyecto)
            $destination = "C:/xampp/htdocs/sistema_tropical/assets/imagenes/clientes/" . $new_name;
    
            // Descargar la imagen desde la URL
            $imagen = file_get_contents($cli_img);
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
    




    public function guardarImagenDesdeUrlHosting($cli_img) {
        if (filter_var($cli_img, FILTER_VALIDATE_URL)) {
            // Generar un nombre único para la imagen
            $extension = pathinfo($cli_img, PATHINFO_EXTENSION) ?: 'png';
            $new_name = time() . rand(1000, 9999) . '.' . $extension;
    
            // Definir la URL del backend para subir la imagen
            $uploadEndpoint = "https://sistema.haromdev.com/controllers/controller_cliente.php";
    
            // Enviar la imagen al backend
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $uploadEndpoint);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'image_url' => $cli_img,
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
