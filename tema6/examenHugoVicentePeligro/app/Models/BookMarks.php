<?php
namespace App\Models;

class BookMarks extends DBAbstractModel{

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
    private $bm_url;
    private $descripcion;
    private $idUsuario;

    public function setbmUrl($url){
        $this->bm_url = $url;
    }

    public function getbmUrl(){
        return $this->bm_url;
    }

    

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }


    public function getMensaje(){
        return $this->mensaje;
    }

    function get(){
        $this->query = "SELECT * FROM bookmarks";
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
    function obtenerEnlace($idUsuario)
    {
        $this->query = "SELECT * FROM bookmarks where idUsuario = :idUsuario";
        $this->parametros["idUsuario"] = $idUsuario;
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

    function set(){
        $this->query = "INSERT INTO bookmarks(bm_url,descripcion,idUsuario) VALUES(:bm_url,:descripcion,:idUsuario)";
        $this->parametros["bm_url"] = $this->bm_url;
        $this->parametros["descripcion"] = $this->descripcion;
        $this->parametros["idUsuario"] = $this->idUsuario;
        $this->mensaje = $this->get_results_from_query() ? "Equipo añadido" : "No se pudo añadir";
    }

    function delete($id = ""){
        $this->query = "DELETE FROM bookmarks WHERE id = :id";
        $this->parametros["id"] = $id;
        $this-> get_results_from_query();
        $this-> mensaje = "sh eliminado";
    }

    function edit(){

    }

    



    



}
?>