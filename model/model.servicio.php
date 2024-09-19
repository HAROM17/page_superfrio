<?php

require_once "config/conexion.php";

class ServModel{

	public static function ModModelServ($tabla){

		$stmt = Conectar::Conexion()->prepare("SELECT serv_titulo, serv_descrip, serv_icon  FROM $tabla WHERE emp_id = 1 AND est = 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->closeCursor();

	}

}