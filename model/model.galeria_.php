<?php
require_once "../config/conexion.php";

class Galeria extends Conectar
{

	/* Listar galería por empresa */
	public function get_galeria_x_emp_id($emp_id)
	{
		$conectar = parent::Conexion();
		$sql = "CALL sp_l_galeria_01(?)";
		$query = $conectar->prepare($sql);
		$query->bindValue(1, $emp_id);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}
