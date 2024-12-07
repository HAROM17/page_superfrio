<?php
    // Llamando Clases
    require_once("../config/conexion.php");
    require_once("../model/model.cliente.php");

    ///Inicializando clase
    $cliente = new Cliente();

    switch ($_GET["op"]) {

        case "login_cliente":
            $cli_correo = $_POST["cli_correo"];
            $cli_pass = $_POST["cli_pass"];
            $emp_id = $_POST["emp_id"];
        
            if (!empty($cli_correo) && !empty($cli_pass) && !empty($emp_id)) {
                $resultado = $cliente->loginCliente($cli_correo, $cli_pass, $emp_id);
        
                if ($resultado) {
                    session_start();
                    $_SESSION["cli_id"] = $resultado["cli_id"];
                    $_SESSION["cli_nom"] = $resultado["cli_nom"];
                    $_SESSION["cli_ape"] = $resultado["cli_ape"];
                    $_SESSION["cli_correo"] = $resultado["cli_correo"];
                    $_SESSION["cli_telf"] = $resultado["cli_telf"];
                    $_SESSION["cli_direc"] = $resultado["cli_direc"];
                    $_SESSION["emp_id"] = $resultado["emp_id"];
                    echo "1"; 
                } else {
                    echo "0"; 
                }
            } else {
                echo "-1"; 
            }
            break;
        

        case "acceso_google":
            $correo = $_POST["cli_correo"];
            $emp_id = $_POST["emp_id"];
            $datos = $cliente->get_cliente_x_correo($correo, $emp_id);
        
            if (count($datos) == 0) {
                echo "0"; // Cliente no encontrado
            } else {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION["cli_id"] = $datos[0]["cli_id"];
                $_SESSION["emp_id"] = $datos[0]["emp_id"];
                $_SESSION["cli_nom"] = $datos[0]["cli_nom"];
                $_SESSION["cli_ape"] = $datos[0]["cli_ape"];
                $_SESSION["cli_correo"] = $datos[0]["cli_correo"];
                $_SESSION["cli_telf"] = $datos[0]["cli_telf"];
                $_SESSION["cli_img"] = $datos[0]["cli_img"];
                $_SESSION["cli_direc"] = $datos[0]["cli_direc"];
                $_SESSION["emp_nom"] = $datos[0]["emp_nom"];
                echo "1"; // Cliente encontrado e inicio de sesión exitoso
            }
            break;

        case "register_cliente":
            $cli_nom = $_POST["cli_nom"];
            $cli_ape = $_POST["cli_ape"];
            $cli_dni = $_POST["cli_dni"];
            $cli_correo = $_POST["cli_correo"];
            $cli_pass = $_POST["cli_pass"];
        
            // Verificar si el correo ya existe
            $existe_cliente = $cliente->get_cliente_x_correo($cli_correo, 1);
            if (count($existe_cliente) > 0) {
                echo json_encode(["success" => false, "message" => "El correo ya está registrado."]);
            } else {
                // Registrar al cliente
                $result = $cliente->insert_cliente($cli_nom, $cli_ape, $cli_dni, $cli_correo, $cli_pass);
        
                if ($result) {
                    echo json_encode(["success" => true, "message" => "Cuenta registrada exitosamente."]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error al registrar la cuenta."]);
                }
            }
            break;
        
        case "register_cliente_google":
            $data = json_decode(file_get_contents("php://input"), true);
        
            $cli_nom = $data["cli_nom"];
            $cli_ape = $data["cli_ape"];
            $cli_correo = $data["cli_correo"];
            $cli_img = $data["cli_img"];
            $emp_id = 1; // ID de la empresa
        
            // Verificar si el cliente ya existe
            $clienteExistente = $cliente->get_cliente_x_correo($cli_correo, $emp_id);
            if (!empty($clienteExistente)) {
                echo json_encode(["success" => false, "message" => "El correo ya está registrado."]);
                exit();
            }
        
            // Guardar la imagen desde la URL
            $fotoGuardada = $cliente->guardarImagenDesdeUrlHosting($cli_img);
            if (!$fotoGuardada) {
                echo json_encode(["success" => false, "message" => "Error al guardar la imagen."]);
                exit();
            }
        
            // Registrar al cliente
            $resultado = $cliente->insert_cliente_google($cli_nom, $cli_ape, $cli_correo, $fotoGuardada, $emp_id);
        
            echo json_encode([
                "success" => $resultado,
                "message" => $resultado ? "Registro exitoso." : "Error al registrar el cliente."
            ]);
            break;

        
    }
?>



