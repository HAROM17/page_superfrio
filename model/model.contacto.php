<?php

require_once "config/conexion.php";

class ContactoModel{

	public static function ModelContacto($tabla){

		$stmt = Conectar::Conexion()->prepare("SELECT emp_nom, emp_ruc, emp_telef, emp_correo, emp_direc FROM $tabla WHERE emp_id = 1");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->closeCursor();

	}

}