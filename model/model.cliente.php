<?php
class Cliente extends Conectar
{


    /* Listar registro por ID */
    public function get_empresa_x_emp_id($emp_id){
        $conectar = parent::Conexion();
        $sql = "CALL sp_l_empresa_02(?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }        
    
    public function insert_clientes($emp_id, $cli_correo, $cli_pass)
    {
        $conectar = parent::conexion();
        $sql = "CALL registrar_cliente(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id);
        $query->bindValue(2, "");
        $query->bindValue(3, "");
        $query->bindValue(4, "");
        $query->bindValue(5, $cli_correo);
        $query->bindValue(6, "");
        $query->bindValue(7, "");
        $query->bindValue(8, $cli_pass);
        $query->bindValue(9, "");
        $query->execute();
    }

    /* Verificar si el correo electrónico ya está registrado */
    public function verificarCorreo($correo)
    {
        $conectar = parent::conexion();
        $sql = "SELECT COUNT(*) AS total FROM tm_cliente WHERE cli_correo = ?";
        $query = $conectar->prepare($sql);
        $query->execute([$correo]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $total = $row['total'];

        return ($total > 0) ? true : false;
    }


    /* Acceso a la tienda virtual */
    public function loginCliente()
    {
        $conectar = parent::Conexion();

        if (isset($_POST["enviar"])) {
            // Recepción de parámetros desde el formulario de login
            $correo = $_POST["cli_correo"];
            $pass = $_POST["cli_pass"];
            $emp_id = $_POST["emp_id"];

            if (empty($correo) || empty($pass) || empty($emp_id)) {
                // Manejar el error si alguno de los campos está vacío
                header("Location: " . Conectar::ruta() . "index.php?m=erroralacceder");
                exit();
            } else {
                $sql = "CALL login_cliente(?, ?, ?)";
                $query = $conectar->prepare($sql);
                $query->bindValue(1, $emp_id);
                $query->bindValue(2, $correo);
                $query->bindValue(3, $pass);
                $query->execute();
                $resultado = $query->fetch();

                if (is_array($resultado) && count($resultado) > 0) {
                    // Iniciar sesión y establecer variables de sesión para el cliente
                    session_start();
                    $_SESSION["cli_id"] = $resultado["cli_id"];
                    $_SESSION["cli_nom"] = $resultado["cli_nom"];
                    $_SESSION["cli_ape"] = $resultado["cli_ape"];
                    $_SESSION["cli_correo"] = $resultado["cli_correo"];
                    $_SESSION["cli_telf"] = $resultado["cli_telf"];
                    $_SESSION["cli_direc"] = $resultado["cli_direc"];
                    $_SESSION["fech_crea"] = $resultado["fech_crea"];
                    $_SESSION["cli_img"] = $resultado["cli_img"];
                    $_SESSION["emp_id"] = $resultado["emp_id"];

                    // Redireccionar al index.php después del login exitoso
                    header("Location: " . Conectar::ruta());
                    exit();
                } else {
                    // Redirigir a la página de inicio de sesión con mensaje de error
                    header("Location: " . Conectar::ruta() . "index.php?m=erroralacceder");
                    exit();
                }
            }
        } else {
            header("Location: " . Conectar::ruta());
            exit();
        }
    }

    public function verificarClienteContrasena($cli_id, $password) {
        $conectar = parent::Conexion(); // Ajusta según tu método de conexión
        $sql = "SELECT cli_id FROM tm_cliente WHERE cli_id = ? AND cli_pass = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id);
        $query->bindValue(2, $password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Retorna true si se encontró el cliente con esa contraseña, false si no
        return ($result !== false);
    }

    /* Eliminar cliente */
    public function eliminar_cuenta($cli_id)
    {
        $conectar = parent::Conexion();
        $sql = "CALL sp_d_cliente_01(?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id);
        $query->execute();

    }
}
