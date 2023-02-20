<?php
$carritoEquipo = array("equipo"=> "España", "zona" => "b","entrada" => array());
foreach ($carritoEquipo as $key => $value) {
    if ($key == "entrada") {
        
        foreach (["127" => 140,"120"=>440] as $nEntrada => $precio) {
            
                $zonaPrecio = array("numero" => $nEntrada,"precio" => $precio);
                array_push($carritoEquipo[$key], $zonaPrecio);
            
        }
        
    }
}
var_dump($carritoEquipo);

?>