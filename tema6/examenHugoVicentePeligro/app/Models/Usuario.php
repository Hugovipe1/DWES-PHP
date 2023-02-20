<?php
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
    
    public $id;
    private $perfil;
    private $bloqueado;

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setUser($user){
        $this->mensaje = $user;
    }

    public function setPsw($psw){
        $this->psw = $psw;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    public function setBloqueado($bloqueado){
        $this->bloqueado = $bloqueado;
    }

    public function getBloqueado(){
        return $this->bloqueado;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }


    public function getPerfil(){
        return $this->perfil;
    }


    public function existe($user, $psw){
        $this->query = "SELECT * FROM usuarios WHERE user = :user and psw = :psw";
        $this->parametros["user"] = $user;
        $this->parametros["psw"] = $psw;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return $this->rows;
        }
        else {
            return null;
        }
    }

    public function existeUsuario($user){
        $this->query = "SELECT * FROM usuarios WHERE user = :user";
        $this->parametros["user"] = $user;
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getBloqueados(){
        $this->query = "SELECT * FROM usuarios WHERE bloqueado = 1";
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        }
        else {
            $this->mensaje = 'sh no encontrado';
        }
        return $this->rows;
    }

    public function bloquear($user){
        $this->query = "UPDATE usuarios SET bloqueado = 1 WHERE user = :user";
        $this->parametros["user"] = $user;
        $this->get_results_from_query();
        
    }

    public function desbloquear($users){
        foreach ($users as $value) {
            $this->query = "UPDATE usuarios SET bloqueado = 0 WHERE id = :id";
            $this->parametros["id"] = $value;
            $this->get_results_from_query();
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