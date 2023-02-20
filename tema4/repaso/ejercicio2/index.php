<?php

session_start();

$noticias=array(
    "videojuegos"=>array("Videojuego1","Videojuego2","Videojuego3"),
    "series"=>array("Serie1","Serie2","Serie3"),
    "cine"=>array("Pelicula1","Pelicula2","Pelicula3"),
    "literatura"=>array("Literatura1","Literatura2","Literatura3")
);

$aUsuarios=array(
    array('usuario'=>"editor",'psw'=>'editor','perfil'=>'editor'),
    array('redactor'=>"redactor","psw"=>'redactor',"perfil"=>"redactor")
);

if(isset($_POST['reiniciar'])){
    unset($_SESSION['contactos']);
    session_destroy();
    session_start();
    session_regenerate_id(true);
}

$nombre=""; 
$psw="";
$_SESSION['usuario']=null;
if(isset($_POST['enviar']) && !empty($_POST['nombre']) && !empty($_POST['psw'])){

    $nombre=clearData($_POST['nombre']);
    $psw=$_POST['psw'];

    foreach($aUsuarios as $key=>$array){
        if($array['perfil']=="editor"){
            if($array['usuario']==$nombre && $array['psw']==$psw){
                $_SESSION['usuario']=$array['usuario'];
                $_SESSION['psw']=$array['psw'];
                $_SESSION['perfil']=$array['perfil'];
                $_SESSION['noticias']=$noticias;
            }
        }else{
            if($array['redactor']==$nombre && $array['psw']==$psw){
                $_SESSION['usuario']=$array['redactor'];
                $_SESSION['psw']=$array['psw'];
                $_SESSION['perfil']=$array['perfil'];
                $_SESSION['noticias']=$noticias;
            }
        }
    }

}


function clearData($cadena){
    $cadena_limpia = trim($cadena);
    $cadena_limpia = htmlspecialchars($cadena_limpia);
    $cadena_limpia = stripslashes($cadena_limpia);
    return $cadena_limpia;
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <?php
        
        if(isset($_SESSION['perfil'])&& isset($_SESSION['usuario'])){
            if($_SESSION['perfil']=="editor"){ //EDITOR
                echo "Soy un editor"."<br>";
                echo "<a href=crearCategoria.php>Crear categoria</a>"."<br>";
                echo "<a href=salir.php>Salir</a><br>";
                echo "<a href=logout.php>Cerrar sesion</a>";
            }else if($_SESSION['perfil']){ //REDACTOR
                echo "Soy un redactor"."<br>";
                echo "<a href=crearNoticia.php>Crear noticia</a>"."<br>";
                echo "<a href=salir.php>Salir</a><br>";
                echo "<a href=logout.php>Cerrar sesion</a>";
            }
        }else{
            echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">';
            echo '<input type="text" name="nombre" value="'.$nombre.'"/><br>';
            echo '<input type="password" name="psw" value="'.$psw.'"/><br>';
            echo '<input type="submit" name="enviar" value="Enviar"/><br>';
            echo '<input type="submit" name="reiniciar" value="reiniciar"/>';
            echo '</form>';
            echo '<br>';
            echo '<h1></h1>';
        }

    ?>
</body>
</html>