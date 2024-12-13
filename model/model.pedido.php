<?php

class Pedido extends Conectar {
    public function crearPedido($cli_id, $emp_id, $carrito, $voucher) {
        $conectar = parent::conexion();
        $conectar->beginTransaction();
    
        try {
            // Guardar la imagen del voucher
            $voucherFileName = null;
            if ($voucher) {
                $voucherFileName = $this->guardarVoucherEnHosting($voucher);
                if (!$voucherFileName) {
                    throw new Exception("Error al guardar la imagen del voucher.");
                }
            }
    
            // Insertar el pedido
            $sqlPedido = "INSERT INTO tm_pedido (cli_id, emp_id, ped_subtotal, ped_igv, ped_total, ped_voucher) 
                          VALUES (?, ?, ?, ?, ?, ?)";
            $subtotal = array_sum(array_map(fn($item) => $item['prod_precio'] * $item['cantidad'], $carrito));
            $igv = $subtotal * 0.00;
            $total = $subtotal + $igv;
    
            $queryPedido = $conectar->prepare($sqlPedido);
            $queryPedido->bindValue(1, $cli_id, PDO::PARAM_INT);
            $queryPedido->bindValue(2, $emp_id, PDO::PARAM_INT);
            $queryPedido->bindValue(3, $subtotal, PDO::PARAM_STR);
            $queryPedido->bindValue(4, $igv, PDO::PARAM_STR);
            $queryPedido->bindValue(5, $total, PDO::PARAM_STR);
            $queryPedido->bindValue(6, $voucherFileName, PDO::PARAM_STR);
            $queryPedido->execute();
    
            $pedidoId = $conectar->lastInsertId();
    
            // Insertar detalles del pedido
            $sqlDetalle = "INSERT INTO td_pedido_detalle (ped_id, prod_id, cantidad, precio_unitario, total) 
                           VALUES (?, ?, ?, ?, ?)";
            foreach ($carrito as $item) {
                $queryDetalle = $conectar->prepare($sqlDetalle);
                $queryDetalle->bindValue(1, $pedidoId, PDO::PARAM_INT);
                $queryDetalle->bindValue(2, $item['prod_id'], PDO::PARAM_INT);
                $queryDetalle->bindValue(3, $item['cantidad'], PDO::PARAM_INT);
                $queryDetalle->bindValue(4, $item['prod_precio'], PDO::PARAM_STR);
                $queryDetalle->bindValue(5, $item['prod_precio'] * $item['cantidad'], PDO::PARAM_STR);
                $queryDetalle->execute();
            }
    
            // Vaciar el carrito
            $sqlVaciarCarrito = "DELETE FROM tm_carrito WHERE cli_id = ? AND emp_id = ?";
            $queryVaciarCarrito = $conectar->prepare($sqlVaciarCarrito);
            $queryVaciarCarrito->bindValue(1, $cli_id, PDO::PARAM_INT);
            $queryVaciarCarrito->bindValue(2, $emp_id, PDO::PARAM_INT);
            $queryVaciarCarrito->execute();
    
            $conectar->commit();
            return ["success" => true, "message" => "Pedido creado correctamente."];
        } catch (Exception $e) {
            $conectar->rollBack();
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
    
    private function guardarImagen($imageFile) {
        $uploadDir ="C:/xampp/htdocs/sistema_tropical/assets/imagenes/vouchers/";
        $fileName = time() . "_" . uniqid() . "." . pathinfo($imageFile['name'], PATHINFO_EXTENSION);
    
        if (move_uploaded_file($imageFile['tmp_name'], $uploadDir . $fileName)) {
            return $fileName;
        }
    
        return false;
    }

    private function guardarVoucherEnHosting($imageFile) {
        $uploadEndpoint = "https://sistema.haromdev.com/controllers/controller_pedidos.php";
        $fileName = time() . "_" . uniqid() . "." . pathinfo($imageFile['name'], PATHINFO_EXTENSION);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uploadEndpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'voucher_name' => $fileName, // Nombre del archivo en el servidor
            'voucher_file' => new CURLFile($imageFile['tmp_name'], $imageFile['type'], $fileName), // Archivo a enviar
        ]);
    
        $response = curl_exec($ch); // Ejecuta la solicitud
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpCode === 200) {
            $result = json_decode($response, true);
            if ($result && $result['success']) {
                return $fileName; // Retorna el nombre del archivo si fue exitoso
            }
        }
    
        return false; // Retorna false si falla
    }
    
    
}

?>
