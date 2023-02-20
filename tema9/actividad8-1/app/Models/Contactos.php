<?php
namespace App\Models;

class Contactos extends DBAbstractModel{
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

    public function set(){

    }

    public function setContactos($input){
        $this->query = "INSERT INTO contactos(nombre,telefono,email) VALUES(:nombre, :telefono, :email)";

        $this->parametros["nombre"] = $input["nombre"];
        $this->parametros["telefono"] = $input["telefono"];
        $this->parametros["email"] = $input["email"];
        return $this->mensaje = $this->get_results_from_query() ? "Contacto añadido" : "No se pudo añadir";
    }

    public function delete(){

    }

    public function deleteContactos($id){
        $this->query = "DELETE FROM contactos WHERE id = :id";
        $this->parametros["id"] = $id;
        return $this->mensaje = $this->get_results_from_query() ? "Contacto eliminado" : "No se pudo eliminar";
    }

    public function get(){
        $this->query = "SELECT * FROM contactos";
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

    public function getContactById($id){
        $this->query = "SELECT * FROM contactos WHERE id = :id";
        $this->parametros["id"] = $id;
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

    public function edit(){

    }
    
    public function editContactos($input, $id){
        $this->query = "UPDATE contactos set nombre=:nombre, telefono=:telefono, email=:email where id = :id";
        $this->parametros["id"] = $id;
        $this->parametros["nombre"] = $input["nombre"];
        $this->parametros["telefono"] = $input["telefono"];
        $this->parametros["email"] = $input["email"];
        return $this->mensaje = $this->get_results_from_query() ? "Contacto modificado" : "No se pudo modificar el contacto";
    }
}

?>