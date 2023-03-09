<?php
/**
 * @author Hugo Vicente Peligro
 */

 namespace App\Models;

class Usuario extends  DBAbstractModel{

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
    
    private $id;
    private $usuario;
    private $passwd;
    
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }


    public function existe(){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario and password = :password";
        $this->parametros["usuario"] = $this->usuario;
        $this->parametros["password"] = $this->passwd;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return $this->rows;
        }
        else {
            return null;
        }
    }

    function get()
    {
    }

    function set(){
    }
    function delete(){

    }

    function edit(){

    }
 }


?>