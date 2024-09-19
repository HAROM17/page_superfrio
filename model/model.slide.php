<?php

require_once "config/conexion.php";

class SlideModel{

	public static function ModelSlide($tabla){

		$stmt = Conectar::Conexion()->prepare("SELECT sli_img FROM $tabla WHERE emp_id= 1 AND est = 1");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->closeCursor();

	}

}