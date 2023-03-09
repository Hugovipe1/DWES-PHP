<?php
/**
 * @author Hugo Vicente peligro
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

    private $id;
    private $nombre;
    private $usuario;
    private $password;
    private $perfil;
    private $puntos;

    public function setId($id){
        $this->id = $id;
    }
    
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    public function setPuntos($puntos){
        $this->puntos = $puntos;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function existe(){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario and password = :password";
        $this->parametros["usuario"] = $this->usuario;
        $this->parametros["password"] = $this->password;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function addPuntos(){
        $this->query = "UPDATE usuarios SET puntos = puntos + :puntos WHERE id = :id";
        $this->parametros["puntos"] = $this->puntos;
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function getAgente(){
        $this->query = "SELECT * FROM usuarios WHERE id = :id";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function getConductores(){
        $this->query = "SELECT * FROM usuarios WHERE perfil = :conductor";
        $this->parametros["conductor"] = "conductor";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            return $this->rows;
        }
        else{
            return null;
        }
    }


    public function getIdUsuario($nombre){
        $this->query = "SELECT id FROM usuarios WHERE nombre = :nombre";
        $this->parametros["nombre"] = $nombre;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function get(){
        $this->query = "SELECT * FROM usuarios where id = :id";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function getAll(){
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function obtenerNumSanciones(){
        $this->query = "SELECT COUNT(*) FROM multas WHERE id_conductor = :id_conductor";
        $this->parametros["id_conductor"] = $this->id;
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function getConductorByName(){
        $this->query = "SELECT * FROM usuarios WHERE nombre LIKE :nombre";
        //Cargamos los parámetros.
        $this->parametros["nombre"] = "%" . $this->nombre . "%";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            return $this->rows;
        }
        else{
            return null;
        }
    }

    public function set(){

    }

    public function edit(){

    }

    public function delete(){

    }

 }
?>