<?php

namespace App\Models;

use App\Models\DBAbstractModel;



/**
 * @author Hugo Vicente Peligro
 */


class Superheroe extends DBAbstractModel
{

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
    private $nombre;
    private $velocidad;
    private $created_at;
    private $updated_at;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
    }

    public function getVelocidad()
    {
        return $this->velocidad;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function get()
    {
        if ($this->nombre != '') {
            $this->query = "SELECT *
            FROM superheroes
            WHERE nombre LIKE :nombre";
            //Cargamos los parámetros.
            $this->parametros["nombre"] = "%" . $this->nombre . "%";
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

    public function getSuperheroeById(){
        if ($this->id != '') {
            $this->query = "SELECT *
            FROM superheroes
            WHERE id LIKE :id";
            //Cargamos los parámetros.
            $this->parametros["id"] = $this->id;
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

        $this->query = "SELECT * FROM superheroes";
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

    public function set()
    {
        $this->query = "INSERT INTO superheroes(nombre,velocidad) VALUES(:nombre,:velocidad)";
        $this->parametros["nombre"] = $this->nombre;
        $this->parametros["velocidad"] = $this->velocidad;
        $this->mensaje = $this->get_results_from_query() ? "Equipo añadido" : "No se pudo añadir";
    }

    public function edit()
    {
        $this->query =
            "UPDATE superheroes set nombre=:nombre, velocidad=:velocidad, updated_at=:updated_at where id = :id";
        $this->parametros["id"] = $this->id;
        $this->parametros["nombre"] = $this->nombre;
        $this->parametros["velocidad"] = $this->velocidad;
        $mFormat = "Y/m/d H:i";
        $mDate = new \DateTime();
        $this->updated_at = $mDate->format($mFormat);
        $this->parametros["updated_at"] = $this->updated_at;
        $this->get_results_from_query();
        $this->mensaje = "sh modificado";
    }

    public function delete($id = '')
    {
        $this->query = "DELETE FROM superheroes WHERE id = :id";
        $this->parametros["id"] = $id;
        $this->get_results_from_query();
        $this->mensaje = "sh borrado";
    }
}
