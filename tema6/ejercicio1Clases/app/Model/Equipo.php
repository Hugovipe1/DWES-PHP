<?php
require "../../vendor/autoload.php";
class Equipo extends DBAbstractModel{
    
    private static $instancia;
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone(){
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }

    private $nombre;
    function get()
    {
        
    }

    function set()
    {
        
    }

    function edit()
    {
        
    }

    function delete(){

    }
}
?>