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

    public static function ruta1() {
        return "http://localhost/page_superfrio/";
    }

    public static function ruta_back() {
        return "https://sistema.haromdev.com/";
        //return "http://localhost/sistema_Tropical/";
    }


    static public function ruta(){
        if(!empty($_SERVER["HTTPS"]) && ("on" == $_SERVER["HTTPS"])){
            return "https://".$_SERVER["SERVER_NAME"]."/";
        }else{
            return "http://".$_SERVER["SERVER_NAME"]."/";
        }

    }

}

