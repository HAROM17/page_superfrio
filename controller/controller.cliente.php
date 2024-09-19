<?php
require_once("../config/conexion.php");
require_once("../model/model.cliente.php");

$cliente = new Cliente();

switch($_GET["op"]) {
    case "registrar_cliente":
        // Verificar si el correo electrónico ya está registrado
        $correo = $_POST["cli_correo"];
        $existe_correo = $cliente->verificarCorreo($correo);
        
        if($existe_correo) {
            echo json_encode(array("success" => false, "message" => "El correo electrónico ya está registrado."));
        } else {
            // El correo electrónico no está registrado, procede con el registro
            $emp_id = $_POST["emp_id"];
            $cli_correo = $_POST["cli_correo"];
            $cli_pass = $_POST["cli_pass"];
            
            $cliente->insert_clientes($emp_id, $cli_correo, $cli_pass);
            
            // Devolver mensaje de éxito
            echo json_encode(array("success" => true, "message" => "Registro exitoso."));
        }
        break;



    case "registrar_cliente_pass_proted":
        $correo = $_POST["cli_correo"];
        $existe_correo = $cliente->verificarCorreo($correo);
        
        if($existe_correo) {
            echo json_encode(array("success" => false, "message" => "El correo electrónico ya está registrado."));
        } else {
            $emp_id = $_POST["emp_id"];
            $cli_correo = $_POST["cli_correo"];
            $cli_pass = $_POST["cli_pass"];
            $cli_pass_hash = password_hash($cli_pass, PASSWORD_DEFAULT);
            $cliente->insert_clientes($emp_id, $cli_correo, $cli_pass_hash);
            echo json_encode(array("success" => true, "message" => "Registro exitoso."));
        }
        break;

        case "eliminarcuenta":
            // Verificar si se han proporcionado cli_id y password
            if (isset($_POST['cli_id']) && isset($_POST['password'])) {
                $cli_id = $_POST['cli_id'];
                $password = $_POST['password'];
    
                // Verificar la contraseña antes de proceder a eliminar la cuenta
                $cliente_valido = $cliente->verificarClienteContrasena($cli_id, $password);
    
                if ($cliente_valido) {
                    // La contraseña es válida, procede a eliminar la cuenta
                    $cliente->eliminar_cuenta($cli_id);
    
                    // Envía una respuesta JSON indicando éxito
                    echo json_encode(array('success' => true, 'message' => 'Cuenta eliminada exitosamente.'));
                } else {
                    // La contraseña no coincide, envía una respuesta JSON indicando error
                    echo json_encode(array('success' => false, 'message' => 'La contraseña ingresada no es válida.'));
                }
            } else {
                // Si no se proporcionaron todos los datos necesarios, envía una respuesta JSON indicando error
                echo json_encode(array('success' => false, 'message' => 'Datos incompletos. Por favor, intenta de nuevo.'));
            }
            break;

            

}
?>




    

