<?php
/**
 * @author Hugo Vicente Peligro
 * Crear un array con los alumnos de clase y permitir la selección aleatoria de uno de ellos. El resultado 
 * debe mostrar nombre y fotografía.
 * 
 * "María Cervilla", "Javier Sánchez", "Jose Luis Pérez", "Jose Miguel Escribano", "Raul Pantoja", "Juan", "Antonio", "Alex", "Gontzal", "Alvaro Garcia")

 */

    $alumnos = array(
                        array("nombre" => "María Cervilla", "foto" => "alumno1.jpg"),
                         array("nombre" => "Javier Sanchez", "foto" => "alumno2.jpg"),
                         array("nombre" => "Jose Luis Pérez", "foto" => "alumno3.jpg"),
                         array("nombre" => "Jose Miguel Escribano", "foto" => "alumno4.jpg"),
                         array("nombre" => "Raul Pantoja", "foto" => "alumno5.jpg"),
                         array("nombre" => "Juan", "foto" => "alumno6.jpg"),
                        array("nombre" => "Antonio", "foto" => "alumno7.jpg"),
                        array("nombre" => "Alex", "foto" => "alumno8.jpg"),
                        array("nombre" => "Gontzal", "foto" => "alumno9.jpg"),
                        array("nombre" => "Alvaro García", "foto" => "alumno10.jpg")
    );
    $numero = rand(0, count($alumnos) - 1);
    $img = $alumnos[$numero]["foto"];
    echo("<img src=\"$img\" alt=\"Foto personal\">");

?>