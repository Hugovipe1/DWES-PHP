<?php
require_once("./Contador.php");
$instanciaContador = new Contador();
echo "Numero de instancias ". $instanciaContador->getNumContadorInstancias();
echo $instanciaContador->incremento()."<br/>";
echo $instanciaContador->incremento()."<br/>";
echo $instanciaContador->incremento()."<br/>";
echo $instanciaContador->mostrar()."<br/>";

$instanciaContador2 = new Contador();
echo $instanciaContador2->incremento()."<br/>";
echo $instanciaContador2->incremento()."<br/>";
echo $instanciaContador->mostrar()."<br/>";

?>