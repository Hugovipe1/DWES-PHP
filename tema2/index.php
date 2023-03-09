<?php
$ejercicios = array(
    "tema2" =>
    array(
        "ejercicio1" =>
        array("titulo" => "ejercicio1", "tags" => "introduccionPHP", "descripcion" => "Hola Mundo", "ruta" => "./ejercicio1.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio1.php"),
        "ejercicio2" =>
        array("titulo" => "ejercicio2", "tags" => "introduccionPHP", "descripcion" => "Ficha personal", "ruta" => "./ejercicio2.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio2.php"),

        "ejercicio3" =>
        array("titulo" => "ejercicio3", "tags" => "introduccionPHP", "descripcion" => "Cálculo del área y la circunferencia del círculo", "ruta" => "./ejercicio3.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio3.php"),
        "ejercicio4" =>
        array("titulo" => "ejercicio4", "tags" => "introduccionPHP", "descripcion" => "Explicación printf", "ruta" => "./ejercicio4.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio4.php"),
        "ejercicio6" =>
        array("titulo" => "ejercicio6", "tags" => "introduccionPHP", "descripcion" => "Salida de operaciones", "ruta" => "./ejercicio6.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio6.php"),
        "ejercicio7" =>
        array("titulo" => "ejercicio7", "tags" => "introduccionPHP", "descripcion" => "Operaciones", "ruta" => "./ejercicio7.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio7.php"),
        "ejercicio8" =>
        array("titulo" => "ejercicio8", "tags" => "introduccionPHP", "descripcion" => "var_dump", "ruta" => "./ejercicio8.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio8.php"),

        "ejercicio9" =>
        array("titulo" => "ejercicio9", "tags" => "introduccionPHP", "descripcion" => "funcion gettype()", "ruta" => "./ejercicio9.php", "enlaceGitHub" => "https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio9.php"),
    )
);


echo "<ul> ";
foreach ($ejercicios as $clave => $valor) {
    echo "<li> $clave";
    echo "<dl>";
    foreach ($valor as $clave2 => $valor2) {

        echo " <dt>$clave2<dt/>
                        <dd>
                            $valor2[titulo]</br>
                            $valor2[tags]</br>
                            $valor2[descripcion]</br>
                            <a href=\"$valor2[ruta]\" target=\"_blank\">Ejecucion</a></br>
                            <a href=\"$valor2[enlaceGitHub]\" target=\"_blank\">Enlace GitHub</a>

                        
                        <dd/>";
    }
    echo "</dl>";


    echo "</li>";
}
echo "</ul>";
?>