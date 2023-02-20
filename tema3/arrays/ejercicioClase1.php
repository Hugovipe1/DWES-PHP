<?php
/**
 * Creación y recorrido de un array.
 * @author Hugo Vicente Peligro
 */
/*$contactos = array(
    array("id"=>1,"nombre"=>"Mafalda","telefono"=>"666123123"),
    array("id"=>2,"nombre"=>"Manolito","telefono"=>"667422100"),
    array("id"=>3,"nombre"=>"Felipe","telefono"=>"668234233"),
);*/
$contactos = [["id"=>1,"nombre"=>"Mafalda","telefono"=>"666123123"],
 ["id"=>2,"nombre"=>"Manolito","telefono"=>"667422100"],
  ["id"=>3,"nombre"=>"Felipe","telefono"=>"668234233"]];
foreach($contactos as $clave=>$valor){
    echo"$clave";
    echo "<br>";
}

?>