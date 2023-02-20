<?php

$noticias=array(
    "videojuegos"=>array("Videojuego1","Videojuego2","Videojuego3"),
    "series"=>array("Serie1","Serie2","Serie3"),
    "cine"=>array("Pelicula1","Pelicula2","Pelicula3"),
    "literatura"=>array("Literatura1","Literatura2","Literatura3")
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar noticias</title>
</head>
<body>
    <?php
        echo "<h1>Resumen de noticias</h1>";
        echo "<a href=index.php>Settings</a><br>";
        if(isset($_COOKIE)){
            foreach($_COOKIE as $key => $value){
                echo "<h1>".$key."</h1>"."<br>";
                foreach($noticias as $clave =>$array){
                    if($clave==$key){
                        foreach($array as $noticia){
                            echo $noticia."<br>";
                        }
                    }
                }
            }
        }

    ?>
</body>
</html>