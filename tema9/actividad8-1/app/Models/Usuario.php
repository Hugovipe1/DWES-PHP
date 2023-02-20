<?php
/**
 * @author Hugo Vicente Peligro
 */

 namespace App\Models;

 class Usuario extends DBAbstractModel{
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
    public function get(){
        
    }
    public function set(){

    }

    public function setUsuario($usuario, $password){
        $this->query = "INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)";
        $this->parametros["usuario"] = $usuario;
        $this->parametros["password"] = $password;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return true;
        }
        else {
            return false;
        }
    }
    public function edit(){
        
    }
    public function delete(){
        
    }

    public function existeUsuario($usuario, $password){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario and password = :password";
        $this->parametros["usuario"] = $usuario;
        $this->parametros["password"] = $password;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function existeUsuarioSinPassword($usuario){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $this->parametros["usuario"] = $usuario;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return true;
        }
        else {
            return false;
        }
    }
    
 }
?>