<?php

    session_start();
    $bandera=false;

    if($_SESSION['perfil']==="editor"){
        $bandera=true;
    }

    if(isset($_POST['enviar'])){
        $nombre=$_POST['nombre'];
        $_SESSION['noticias'][$nombre]=array();
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear categoria</title>
</head>
<body>
    <?php

            if($bandera){
                echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">';
                echo 'Categoria <input type="text" name="nombre"/><br>';
                echo '<input type="submit" name="enviar" value="Enviar"/><br>';
                echo '</form>';
                echo '<br>';
    
                echo "Categorias creadas: "."<br>";
                foreach($_SESSION['noticias'] as $key => $value){
                    echo $key."<br>";
                }
                echo "<a href=salir.php>Salir</a><br>";
                echo "<a href=logout.php>Cerrar sesion</a>";
            }else{
                echo "No tienes acceso";
            }
    ?>
</body>
</html>