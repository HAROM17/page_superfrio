<?php
session_start();
require_once("../../config/conexion.php");
require_once("../../model/model.pedido.php");

if (!isset($_GET['pedido_id'])) {
    echo "<script>alert('No se encontró el pedido.'); window.location.href='../index.php';</script>";
    exit;
}

$pedidoId = $_GET['pedido_id'];
$pedidoModel = new Pedido();
$pedido = $pedidoModel->getPedidoDetalles($pedidoId);

if (!$pedido) {
    echo "<script>alert('No se encontraron los detalles del pedido.'); window.location.href='../index.php';</script>";
    exit;
}

// Verificar el método de pago
$metodoPago = $pedido['metodo_pago']; // Asegúrate de que este dato esté en la consulta getPedidoDetalles()
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if ($metodoPago === 'Yape'): ?>
            <h1 class="thank-you">¡Gracias por realizar tu pedido!</h1>
            <p>Tu pedido ha sido registrado con éxito y está <strong>pendiente de confirmación</strong>. Nuestro equipo verificará el comprobante de pago y te notificará en breve.</p>
        <?php elseif ($metodoPago === 'Tarjeta'): ?>
            <h1 class="thank-you">¡Gracias por tu compra!</h1>
            <p>Tu pedido ha sido procesado con éxito y no requiere confirmación adicional. Te enviaremos un correo con los detalles.</p>
        <?php else: ?>
            <h1 class="thank-you">¡Pedido Realizado!</h1>
            <p>Gracias por tu pedido. Estamos procesando los detalles y te notificaremos pronto.</p>
        <?php endif; ?>

        <div class="order-details">
            <h2>Detalles del pedido</h2>
            <p><strong>Número de Pedido:</strong> #<?php echo htmlspecialchars($pedido['pedido_id']); ?></p>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($pedido['fecha']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($pedido['cliente_correo']); ?></p>
        </div>

        <h2>Resumen de la compra</h2>
        <table class="order-summary">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedido['productos'] as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td>S/ <?php echo number_format($producto['precio_unitario'], 2); ?></td>
                        <td>S/ <?php echo number_format($producto['subtotal'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>S/ <?php echo number_format($pedido['total'], 2); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <?php if ($metodoPago === 'Yape'): ?>
            <p>Recibirás una notificación por correo electrónico una vez que confirmemos tu pedido.</p>
        <?php elseif ($metodoPago === 'Tarjeta'): ?>
            <p>El pago con tarjeta ha sido procesado automáticamente. Gracias por tu compra.</p>
        <?php endif; ?>

        <div class="footer">
            <p>Si tienes alguna pregunta, contáctanos en <a href="mailto:soporte@tienda.com">soporte@tienda.com</a>.</p>
            <p>&copy; 2024 Tienda Virtual. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
