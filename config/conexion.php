<?php
    class Conectar{
        public static function Conexion(){
            $link = new PDO("mysql:host=localhost;dbname=sistema_tropical","root","");
            return $link;
        }

        //Este método público estático devuelve la URL base del sistema 
        public static function ruta() {
            return("http://localhost/proyecto_helados/");
        }

        public static function ruta_backend() {
            return("http://localhost/sistema_tropical/");
        }
    }


