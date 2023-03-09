<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Models;
class Multas extends DBAbstractModel
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
    private $id_agente;
    private $id_conductor;
    private $matricula;
    private $id_tipo_sanciones;
    private $descripcion;
    private $fecha;
    private $importe;
    private $descuento;
    private $estado;

    public function setId($id){
        $this->id = $id;
    }

    public function setIdAgente($idAgente){
        $this->id_agente = $idAgente;
    }

    public function setIdConductor($idConductor){
        $this->id_conductor = $idConductor;
    }

    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }

    public function setIdTipoSanciones($id_tipo_sanciones){
        $this->id_tipo_sanciones = $id_tipo_sanciones;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setImporte($importe){
        $this->importe = $importe;
    }

    public function setDescuento($descuento){
        $this->descuento = $descuento;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getPuntosSancion(){
        $this->query = "SELECT puntos FROM tipo_sanciones WHERE id = :id_tipo_sanciones";
        $this->parametros["id_tipo_sanciones"] = $this->id_tipo_sanciones;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getMultasAgente(){
        $this->query = "SELECT * FROM multas WHERE id_agente = :id_agente";
        $this->parametros["id_agente"] = $this->id_agente;
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

    public function getMultasConductor(){
        $this->query = "SELECT * FROM multas WHERE id_conductor = :id_conductor";
        $this->parametros["id_conductor"] = $this->id_conductor;
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

    public function obtenerTipoSancion(){

        $this->query = "SELECT tipo FROM tipo_sanciones WHERE id = :id";
        $this->parametros["id"] = $this->id_tipo_sanciones;
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

    public function getIdConductorMulta(){
        $this->query = "SELECT id_conductor FROM multas WHERE id = :id";
        $this->parametros["id"] = $this->id;
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


    public function getIdSancion($tipo){

        $this->query = "SELECT id,importe,puntos FROM tipo_sanciones WHERE tipo = :tipo";
        $this->parametros["tipo"] = $tipo;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            return $this->rows;
        }
        else{
            return null;
        }
    }   
    

    public function get(){
        $this->query = "SELECT * FROM multas where id = :id";
        $this->parametros["id"] = $this->id;
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

    public function set(){
        $this->query = "INSERT INTO multas (id_agente, id_conductor, matricula, id_tipo_sanciones, descripcion, fecha, importe, descuento, estado) VALUES (:id_agente, :id_conductor, :matricula, :id_tipo_sanciones, :descripcion, :fecha, :importe, :descuento, :estado)";
        $this->parametros["id_agente"] = $this->id_agente;
        $this->parametros["id_conductor"] = $this->id_conductor;
        $this->parametros["matricula"] = $this->matricula;
        $this->parametros["id_tipo_sanciones"] = $this->id_tipo_sanciones;
        $this->parametros["descripcion"] = $this->descripcion;
        $this->parametros["fecha"] = $this->fecha;
        $this->parametros["importe"] = $this->importe;
        $this->parametros["descuento"] = 0;
        $this->parametros["estado"] = $this->estado;
        $this->mensaje = $this->get_results_from_query() ? "Multas insertada correctamente" : "No se ha podido insertar la multa";
    }

    public function pagarMultas(){
        $this->query = "UPDATE multas SET estado = :estado, descuento = :descuento WHERE id = :id";
        $this->parametros["estado"] = $this->estado;
        $this->parametros["descuento"] = $this->descuento;
        $this->parametros["id"] = $this->id;
        $this->mensaje = $this->get_results_from_query() ? "Multas pagada correctamente" : "No se ha podido pagar la multa";
    }

    public function edit(){

    }

    public function delete(){
    }

}
?>