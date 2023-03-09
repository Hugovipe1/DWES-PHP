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
    private $perfil;
    private $estado;

    public function setId($id){
        $this->id = $id;
    }
    
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }


    public function existe(){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario and password = :password and id in(select usuarios_id from r_usuarios_perfiles where Perfiles_perfil = :perfil)";
        $this->parametros["usuario"] = $this->usuario;
        $this->parametros["password"] = $this->passwd;
        $this->parametros["perfil"] = $this->perfil;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return $this->rows;
        }
        else {
            return null;
        }
    }

    public function obtenerPerfil(){
        $this->query = "SELECT * FROM r_usuarios_perfiles WHERE usuarios_id = :usuarios_id";
        $this->parametros["usuarios_id"] = $this->id;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return $this->rows;
        }
        else {
            return null;
        }
    }

    public function obtenerTiempoInactividad(){
        $this->query = "SELECT * FROM config";
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return $this->rows;
        }
        else {
            return null;
        }
    }

    public function insertarVotacion($recetas_id, $puntuacion){
        $this->query = "INSERT INTO r_usuarios_recetas_votacion (usuarios_id, recetas_id, puntuacion) VALUES (:usuarios_id, :recetas_id, :puntuacion)";
        $this->parametros["usuarios_id"] = $this->id;
        $this->parametros["recetas_id"] = $recetas_id;
        $this->parametros["puntuacion"] = $puntuacion;
        $this->mensaje = $this->get_results_from_query() ? "Receta añadida" : "No se pudo añadir";
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