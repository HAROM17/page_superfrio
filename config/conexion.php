<?php 

class Conectar {
    protected $dbh;

    protected function Conexion() {
        try {
            
            $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=sistema_tropical", "root", "");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names() {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    public static function ruta() {
        //return "https://superfrios.haromdev.com/";
        return "http://localhost/page_superfrio/";
    }

    public static function ruta_back() {
        return "https://sistema.haromdev.com/";
        //return "http://localhost/sistema_Tropical/";
    }

}

