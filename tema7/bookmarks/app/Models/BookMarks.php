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

    public function setbm_url($url){
        $this->bm_url = $url;
    }

    public function getbmUrl(){
        return $this->bm_url;
    }

    public function setId($id){
        $this->id = $id;
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

    public function getBmUrlFrecuentes(){
        $this->query = "SELECT bm_url FROM bookmarks where bm_url NOT IN (SELECT bm_url from bookmarks WHERE idUsuario = :idUsuario) GROUP by bm_url HAVING count(*) > 3";
        $this->parametros["idUsuario"] = $this->idUsuario;
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

    function getIdUsuarioOfBookmark(){
        $this->query = "SELECT * FROM bookmarks where id = :id";
        $this->parametros["id"] = $this->id;
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
    function obtenerEnlace()
    {
        $this->query = "SELECT * FROM bookmarks where idUsuario = :idUsuario";
        $this->parametros["idUsuario"] = $this->idUsuario;
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

    function setFrecuentes(){
        $this->query = "INSERT INTO bookmarks(bm_url,descripcion, idUsuario) VALUES(:bm_url, :descripcion, :idUsuario)";
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
        $this->query =
            "UPDATE bookmarks set bm_url=:bm_url, descripcion=:descripcion where id = :id";
        $this->parametros["id"] = $this->id;
        $this->parametros["bm_url"] = $this->bm_url;
        $this->parametros["descripcion"] = $this->descripcion;
        $this->get_results_from_query();
        $this->mensaje = "sh modificado";
    }

    



    



}
?>