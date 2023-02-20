<?php

    session_start();

    $bandera=false;

    if($_SESSION['perfil']==="redactor"){
        $bandera=true;
    }

    if(isset($_POST['enviar']) && !empty($_POST['nombre']) && !empty($_POST['categoria'])){
        $nombre=$_POST['nombre'];
        $categoria=$_POST['categoria'];
        

        foreach ($_SESSION['noticias'] as $key => $value) {
            if($categoria==$key){ //Si coincide la categoria, la meto
                array_push($_SESSION['noticias'][$categoria],$nombre);
            }
        }

        
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear noticia</title>
</head>
<body>
    <?php

            if($bandera){
                echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">';
                echo 'Categoria<input type="text" name="categoria"/><br>';
                echo 'Noticia<input type="text" name="nombre"/><br>';
                echo '<input type="submit" name="enviar" value="Enviar"/><br>';
                echo '</form>';
                echo '<br>';

                echo "Noticias creadas: "."<br>";
                foreach($_SESSION['noticias'] as $key => $value){
                    echo "<h1>".$key."</h1>"."<br>";
                    foreach($value as $noticia){
                        echo "<p>".$noticia."</p>";
                    }
                }
                echo "<a href=salir.php>Salir</a><br>";
                echo "<a href=logout.php>Cerrar sesion</a>";
            }else{
                echo "No tienes acceso";
            }
    ?>
</body>
</html>