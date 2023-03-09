<?php
/**
 * @author Hugo Vicente Peligro
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Multas</title>
</head>
<body>
    <h1>Gestión multas</h1>
    <h3>Añadir multas</h3>
    <?php
    echo "Bienvenido has inciado sesión como ".$_SESSION["perfil"];
    echo "<br><a href='/logout'>Cerrar sesión</a><br/><br/>";
    echo "<nav>";
    echo "<a href=\"/\">Home</a>&nbsp";
    if ($_SESSION["perfil"] == "agente") {
        echo "&nbsp<a href='/multas/listado'>Listado Multas</a>";
        echo "&nbsp<a href='/multas/add'>Añadir Multas</a>";
    }
    if ($_SESSION["perfil"] == "conductor") {
        echo "&nbsp<a href='/multas/ver'>Multas</a>";
    }
    echo "</nav>";
    echo"<span>Agente: ".$data["agente"][0]["usuario"]." </span>";
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Matricula: <input type="text" name="matricula"></label><br/>
        <label>Fecha: <input type="date" name="fecha"></label><br/>
        <label>Conductor: <select name="nombre" id="">
        <?php
        foreach ($data["conductores"] as $key => $value) {
            echo "<option value=\"$value[nombre]\">$value[nombre]</option>";
        }
            
        ?>
        </select><br/>
        <label>Tipo Sanción:</label>
        <label> <input type="radio" name="sancion" value="leve">Leve</label>
        <label>
            <input type="radio" name="sancion" value="grave">
            Grave
        </label>
        <label>
            <input type="radio" name="sancion" value="mgrave">
            Muy Grave
        </label><br/>
        <label>
            <textarea name="descripcion" cols="30" rows="10">
            </textarea>
        </label><br/>
        <input type="submit" name="add" value="Enviar">
    </form>
    
</body>
</html>