<?php

class Pedido extends Conectar
{

    private function guardarImagen($imageFile)
    {
        $uploadDir = "C:/xampp/htdocs/sistema_tropical/assets/imagenes/vouchers/";
        $fileName = time() . "_" . uniqid() . "." . pathinfo($imageFile['name'], PATHINFO_EXTENSION);

        if (move_uploaded_file($imageFile['tmp_name'], $uploadDir . $fileName)) {
            return $fileName;
        }

        return false;
    }

    private function guardarVoucherEnHosting($imageFile)
    {
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


    public function crearPedido($cli_id, $emp_id, $carrito, $voucher, $pag_id)
    {
        $conectar = parent::conexion();
        $conectar->beginTransaction();

        try {
            // Manejar el voucher
            $voucherFileName = null;
            if ($pag_id === 3) { // Si es Tarjeta
                $voucherFileName = $voucher; // Código generado en el controller
            } elseif ($pag_id === 2 && $voucher) { // Si es Yape
                $voucherFileName = $this->guardarVoucherEnHosting($voucher);
                if (!$voucherFileName) {
                    throw new Exception("Error al guardar la imagen del voucher.");
                }
            }

            // Insertar el pedido
            $sqlPedido = "INSERT INTO tm_pedido (cli_id, emp_id, ped_subtotal, ped_igv, ped_total, ped_voucher, pag_id) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
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
            $queryPedido->bindValue(7, $pag_id, PDO::PARAM_INT);
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
            return $pedidoId;
        } catch (Exception $e) {
            $conectar->rollBack();
            return ["success" => false, "message" => $e->getMessage()];
        }
    }


    public function actualizarCliente($cli_id, $emp_id, $nombres, $apellidos, $dni, $telefono, $direccion)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE tm_cliente 
                SET cli_nom = ?, cli_ape = ?, cli_dni = ?, cli_telf = ?, cli_direc = ?
                WHERE cli_id = ? AND emp_id = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $nombres, PDO::PARAM_STR);
        $query->bindValue(2, $apellidos, PDO::PARAM_STR);
        $query->bindValue(3, $dni, PDO::PARAM_STR);
        $query->bindValue(4, $telefono, PDO::PARAM_STR);
        $query->bindValue(5, $direccion, PDO::PARAM_STR);
        $query->bindValue(6, $cli_id, PDO::PARAM_INT);
        $query->bindValue(7, $emp_id, PDO::PARAM_INT);
        $query->execute();

        return $query->rowCount() > 0; // Devuelve true si se actualizó algún registro
    }

    public function obtenerClientePorId($cli_id, $emp_id)
    {
        $conectar = parent::conexion();
        $sql = "SELECT cli_nom, cli_ape, cli_dni, cli_telf, cli_direc 
                FROM tm_cliente 
                WHERE cli_id = ? AND emp_id = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $emp_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerClientePorId2($cli_id, $emp_id)
    {
        $conectar = parent::conexion();
        $sql = "SELECT cli_nom, cli_ape, cli_dni, cli_correo, cli_telf, cli_direc 
                FROM tm_cliente 
                WHERE cli_id = ? AND emp_id = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $cli_id, PDO::PARAM_INT);
        $query->bindValue(2, $emp_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getPedidoDetalles($pedidoId)
    {
        $conectar = parent::conexion();

        try {
            // Consulta para obtener los detalles del pedido
            $sqlPedido = "SELECT 
                            p.ped_id AS pedido_id, 
                            p.fech_crea AS fecha, 
                            c.cli_correo AS cliente_correo, 
                            c.cli_nom AS cliente_nombre, 
                            p.ped_total AS total,
                            pag.pag_nom AS metodo_pago
                          FROM tm_pedido p
                          JOIN tm_cliente c ON p.cli_id = c.cli_id
                          JOIN tm_pago pag ON p.pag_id = pag.pag_id
                          WHERE p.ped_id = ?";

            $queryPedido = $conectar->prepare($sqlPedido);
            $queryPedido->bindValue(1, $pedidoId, PDO::PARAM_INT);
            $queryPedido->execute();
            $pedido = $queryPedido->fetch(PDO::FETCH_ASSOC);

            if (!$pedido) {
                return false; // Retorna falso si no encuentra el pedido
            }

            // Consulta para obtener los productos asociados al pedido
            $sqlProductos = "SELECT 
                                d.prod_id AS producto_id, 
                                p.prod_nom AS nombre, 
                                sc.subcat_nom AS subcategoria,
                                s.sab_nom AS sabor,
                                d.cantidad, 
                                d.precio_unitario, 
                                (d.cantidad * d.precio_unitario) AS subtotal
                            FROM td_pedido_detalle d
                            JOIN tm_producto p ON d.prod_id = p.prod_id
                            LEFT JOIN tm_subcategoria sc ON p.subcat_id = sc.subcat_id
                            LEFT JOIN tm_sabor s ON p.sab_id = s.sab_id
                            WHERE d.ped_id = ?";

            $queryProductos = $conectar->prepare($sqlProductos);
            $queryProductos->bindValue(1, $pedidoId, PDO::PARAM_INT);
            $queryProductos->execute();
            $productos = $queryProductos->fetchAll(PDO::FETCH_ASSOC);

            // Verificar si hay productos asociados
            if (empty($productos)) {
                $pedido['productos'] = [];
            } else {
                $pedido['productos'] = $productos;
            }

            return $pedido;
        } catch (Exception $e) {
            error_log("Error al obtener detalles del pedido: " . $e->getMessage());
            return false;
        }
    }


    public function obtenerCorreosAdministradores($emp_id)
    {
        $conectar = parent::conexion();
        $sql = "SELECT usu_correo FROM tm_usuario 
                    WHERE emp_id = ? AND rol_id = 8 AND est = 1"; // rol_id = 1 para administradores
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $emp_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_COLUMN); // Devuelve solo los correos en un array

    }
}
