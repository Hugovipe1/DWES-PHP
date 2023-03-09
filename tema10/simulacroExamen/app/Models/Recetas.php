<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Models;
use App\Models\DBAbstractModel;
class Recetas extends DBAbstractModel{
    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }


    private $id;
    private $titulo;
    private $ingredientes;
    private $elaboracion;
    private $etiquetas;
    private $publica;
    private $imagen;
    private $idColaborador;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setIngredientes($ingredientes)
    {
        $this->ingredientes = $ingredientes;
    }
    public function setElaboracion($elaboracion)
    {
        $this->elaboracion = $elaboracion;
    }
    public function setEtiquetas($etiquetas)
    {
        $this->etiquetas = $etiquetas;
    }
    public function setPublica($publica)
    {
        $this->publica = $publica;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
    public function setIdColaborador($idColaborador)
    {
        $this->idColaborador = $idColaborador;
    }

    public function get()
    {
        if ($this->titulo != '') {
            $this->query = "SELECT *
            FROM recetas
            WHERE titulo LIKE :titulo";
            //Cargamos los parámetros.
            $this->parametros["titulo"] = "%" . $this->titulo . "%";
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        } else {
            $this->mensaje = 'sh no encontrado';
        }

        return $this->rows;
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM recetas";
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        } else {
            $this->mensaje = 'sh no encontrado';
        }

        return $this->rows;
    }

    public function getIdColaboradorOfReceta(){
        $this->query = "SELECT * FROM recetas where id = :id";
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

    

    public function set(){
        $this->query = "INSERT INTO recetas (titulo, ingredientes, elaboracion, etiquetas, publica, imagen, idColaborador)
        VALUES (:titulo, :ingredientes, :elaboracion, :etiquetas, :publica, :imagen, :idColaborador)";
        $this->parametros["titulo"] = $this->titulo;
        $this->parametros["ingredientes"] = $this->ingredientes;
        $this->parametros["elaboracion"] = $this->elaboracion;
        $this->parametros["etiquetas"] = $this->etiquetas;
        $this->parametros["publica"] = $this->publica;
        $this->parametros["imagen"] = $this->imagen;
        $this->parametros["idColaborador"] = $this->idColaborador;
        $this->mensaje = $this->get_results_from_query() ? "Receta añadida" : "No se pudo añadir";
    }

    public function edit(){
        $this->query =
            "UPDATE recetas set titulo=:titulo, ingredientes= :ingredientes, elaboracion = :elaboracion, etiquetas = :etiquetas, publica = :publica, imagen = :imagen where id = :id";
        $this->parametros["id"] = $this->id;
        $this->parametros["titulo"] = $this->titulo;
        $this->parametros["ingredientes"] = $this->ingredientes;
        $this->parametros["elaboracion"] = $this->elaboracion;
        $this->parametros["etiquetas"] = $this->etiquetas;
        $this->parametros["publica"] = $this->publica;
        $this->parametros["imagen"] = $this->imagen;
        $this->get_results_from_query();
        $this->mensaje = "sh modificado";
    }
    public function delete(){
        $this->query = "DELETE FROM recetas WHERE id = :id";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = "sh eliminado";

    }

    public function obtenerIdColaboradores(){
        $this->query = "SELECT * FROM recetas";
        $this->get_results_from_query();
        return $this->rows;
    }

    function addRecetaFavorita(){
        $this->query = "INSERT INTO r_usuarios_recetas_favoritas(recetas_id, usuarios_id) VALUES (:id, :idColaborador)";
        $this->parametros["id"] = $this->id;
        $this->parametros["idColaborador"] = $this->idColaborador;
        $this->mensaje = $this->get_results_from_query() ? "Receta añadida" : "No se pudo añadir";
    }

    function obtenerRecetasFavoritas(){
        $this->query = "SELECT * from recetas where id IN (SELECT recetas_id FROM r_usuarios_recetas_favoritas where usuarios_id = :idColaborador)";
        $this->parametros["idColaborador"] = $this->idColaborador;
        $this->get_results_from_query();
        return $this->rows;
    }

    function obtenerPuntuacion(){
        $this->query = "SELECT SUM(puntuacion) FROM r_usuarios_recetas_votacion r WHERE r.recetas_id in (SELECT id from
        recetas where idColaborador = :idColaborador)";
        $this->parametros["idColaborador"] = $this->idColaborador;
        $this->get_results_from_query();
        return $this->rows;
    }

    function getNumeroPublicaciones(){
        $this->query = "SELECT COUNT(*) FROM recetas WHERE idColaborador = :idColaborador";
        $this->parametros["idColaborador"] = $this->idColaborador;
        $this->get_results_from_query();
        return $this->rows;
    }

}


?>