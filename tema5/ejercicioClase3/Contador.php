<?php
/**
 * @author Hugo Vicente Peligro
 */
class Contador{
    private  $_contador;
    private static $numContadorInstancias = 0;

    public function __construct()
    {
        self::$numContadorInstancias++;
    }
    /**public function __construct($num)
    {
        self::$_contador = $num;
        self::$_contador++;   
    }*/
    public function incremento(){
        $this->_contador++;
    }
    public function mostrar(){
        return "Has incrementado el contador ". $this->_contador;
    }
    public function getNumContadorInstancias(){
        return self::$numContadorInstancias;
    }
}


?>