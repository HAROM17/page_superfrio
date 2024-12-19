<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Llamada de las clases necesarias que se usaran en el envío del mail 
require_once("../config/conexion.php");
require_once("model.empresa.php");


class Email extends PHPMailer
{
    protected $gCorreo = 'info@haromdev.com'; // Cambia esto por tu correo
    protected $gContrasena = 'H4n5_g3m41l'; // Cambia esto por tu contraseña

    public function enviarDetallePedido($pedido, $clienteCorreo)
    {
        $empresa = new Empresa();
        $emp_id = $_SESSION['emp_id'];
        $logoEmpresa = $empresa->obtenerInfoEmpresa($emp_id);

        if (!$logoEmpresa) {
            throw new Exception("No se encontró información de la empresa.");
        }
    
        // Generar la URL completa del logo
        $urlBase = Conectar::ruta_back(); // Ruta base
        $logoUrl = $urlBase . 'assets/imagenes/empresas/' . $logoEmpresa['emp_logo'];
        // Configurar el servidor SMTP
        $this->IsSMTP();
        $this->Host = 'smtp.hostinger.com';
        $this->Port = 587;
        $this->SMTPAuth = true;
        $this->SMTPSecure = 'tls';
        $this->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->setFrom($this->gCorreo, "Helados Y Chupetes Super Frio's");
        $this->addAddress($clienteCorreo);
        $this->isHTML(true);
        $this->CharSet = 'UTF-8';
        $this->Subject = "Confirmación de tu pedido #{$pedido['pedido_id']}";

        // Determinar el título y mensaje personalizado según el método de pago
        $tituloMensaje = '';
        $mensajePersonalizado = '';
        if ($pedido['metodo_pago'] === 'Yape') {
            $tituloMensaje = '¡Gracias por realizar tu pedido!';
            $mensajePersonalizado = 'Tu pedido está pendiente de confirmación. Nuestro equipo verificará el comprobante de pago y te notificará en breve.';
        } elseif ($pedido['metodo_pago'] === 'Tarjeta') {
            $tituloMensaje = '¡Gracias por tu compra!';
            $mensajePersonalizado = 'Tu pedido ha sido procesado con éxito y no requiere confirmación adicional.';
        } else {
            $tituloMensaje = '¡Pedido Realizado!';
            $mensajePersonalizado = 'Gracias por tu pedido. Estamos procesando los detalles y te notificaremos pronto.';
        }

        // Cargar la plantilla HTML
        $templatePath = '../view/emails/DetallePedido.html';
        if (!file_exists($templatePath)) {
            echo "Error: No se encontró la plantilla en {$templatePath}";
            return false;
        }

        $template = file_get_contents($templatePath);

        // Reemplazar los placeholders en la plantilla
        $template = str_replace("{{LOGO_EMPRESA}}", $logoUrl, $template);
        $template = str_replace('{{TITULO_MENSAJE}}', $tituloMensaje, $template);
        $template = str_replace('{{MENSAJE_PERSONALIZADO}}', $mensajePersonalizado, $template);
        $template = str_replace('{{PEDIDO_ID}}', htmlspecialchars($pedido['pedido_id']), $template);
        $template = str_replace('{{FECHA_PEDIDO}}', htmlspecialchars($pedido['fecha']), $template);
        $template = str_replace('{{TOTAL_PEDIDO}}', 'S/ ' . number_format($pedido['total'], 2), $template);
        $template = str_replace('{{METODO_PAGO}}', htmlspecialchars($pedido['metodo_pago']), $template);

        // Generar HTML para los productos
        $productosHtml = '';
        foreach ($pedido['productos'] as $producto) {
            $productosHtml .= "
            <tr>
                <td>" . htmlspecialchars($producto['nombre']) . "</td>
                <td>" . htmlspecialchars($producto['cantidad']) . "</td>
                <td>S/ " . number_format($producto['precio_unitario'], 2) . "</td>
                <td>S/ " . number_format($producto['subtotal'], 2) . "</td>
            </tr>";
        }
        $template = str_replace('{{PRODUCTOS}}', $productosHtml, $template);

        $this->Body = $template;

        // Intentar enviar el correo
        try {
            $this->send();
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar el correo: {$this->ErrorInfo}");
            return false;
        }
    }
}
