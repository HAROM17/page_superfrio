<?php
require_once "config/conexion.php";

class GaleriaModel
{

	public static function ModelGaleriaIMG($tabla)
	{

		$stmt = Conectar::Conexion()->prepare("SELECT gale_ruta FROM $tabla WHERE emp_id= 1 AND gale_tipo='foto' AND est = 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->closeCursor();
	}


	public static function ModelGaleriaMV($tabla)
	{
		$stmt = Conectar::Conexion()->prepare("SELECT gale_ruta FROM $tabla WHERE emp_id= 1 AND gale_tipo='video' AND est = 1 LIMIT 3");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->closeCursor();
	}
}

