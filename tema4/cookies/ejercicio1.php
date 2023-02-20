<?php
/**
 * página que permite crear una cookie de duración limitada, comprobar el estado de la 
 * cookie y destruirla.
 * @author Hugo Vicente Peligro
 */
$procesaFormulario = false;
$estado = "";
$eliminar = "";
if(isset($_POST["enviar"])){
    if (isset($_POST["nombreCookie"])) {
        $procesaFormulario = true;
        if (isset($_POST["duracion"])) {
            setcookie("nombre",$_POST["nombreCookie"],time()+intval($_POST["duracion"]));
        }
        if (isset($_POST["estado"])) {
            if (isset($_COOKIE["nombre"])) {
                $estado = "La cookie ". $_POST["nombreCookie"].  " está creada";
            }
            else {
                $estado = "La cookie ". $_POST["nombreCookie"].  " está eliminada";
            }
            
        }
        if (isset($_POST["eliminar"])) {
            setcookie("nombre",$_POST["nombreCookie"],time()-1);
            $eliminar = "La cookie ". $_POST["nombreCookie"]. " está eliminada";
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
    <title>Document</title>
</head>
<body>
    <?php
    if ($procesaFormulario) {
        if(isset($_POST["eliminar"])){
            echo $eliminar;
        }
        else {
            if (isset($_POST["estado"])) {
                echo $estado ;
            }
        }
        ?>
        <form action="" method="post">
            <input type="submit" name="volver" value="Volver a la página de inicio">
        </form>
    <?php    
    }
    else{
        ?>
        <form action="" method="POST">
        <input type="text" placeholder="Nombre de la cookie" name="nombreCookie">
        <br/>
        <input type="number" placeholder="Duración de la cookie" name="duracion">
        <br/>
        <label>Estado</label>
        <input type="checkbox" name="estado" >
        <br/>
        <label>Eliminar</label>
        <input type="checkbox" name="eliminar">
        <br/>
        <input type="submit" name="enviar">
        </form>

<?php
    }
    ?>
    
    

    
    
</body>
</html>