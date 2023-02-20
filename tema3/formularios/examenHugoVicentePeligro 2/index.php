<?php
/**
 * @author Hugo Vicente Peligro
 */


 include("config/config.php");
 include("lib/functions.php");
 $arrayAbonados = generaAbonados(NUM_ABONADOS);
 $contador = 0;
$equipos = array();
$cargaEntradas = false;
$cargaPrecioTotal = false;
$precioEntrada = 0;
$precioTotal = 0;
foreach ($tarifas as $key => $value){
                array_push($equipos, $value["equipo"]);
}

if(isset($_POST["cargaEntradas"])){
    $equipoSeleccionado = $_POST["equipo"];
    if (!empty($_POST["zona"])) {
        $zonaSeleccionada = $_POST["zona"];
        //minimo de contador depende de la zona
        if ($zonaSeleccionada == "a") {
            $contador = 0;
        }
        else if ($zonaSeleccionada == "b") {
            $contador = 100;
        }
        else if ($zonaSeleccionada == "c") {
            $contador = 200;
        }
        else if ($zonaSeleccionada == "d") {
            $contador = 300;
        }
        $cargaEntradas = true;
        foreach ($tarifas as $key => $value) {
            if ($value["equipo"] == $equipoSeleccionado) {
                
                $precioEntrada = $value[$_POST["zona"]];
            }
        }
    }

}

if(isset($_POST["calculaPrecio"])){
    if(isset($_POST["entradas"])){
        
    $cargaPrecioTotal = true;
    $precioEntrada = $_POST["precioEntrada"];//Se envia a través de un input del tipo hidden
    $precioTotal = $precioEntrada * count($_POST["entradas"]);
        
    }
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ExamenFormularios</title>
</head>
<body>
    <div>
        <h1>Venta de entradas del club de baloncesto Pokemons</h1>
    </div>
    
    <form action="" method="POST">
    <?php
    echo "Partido contra el equipo: ";
    ?>
    <select name="equipo">
        <?php
        
            foreach ($equipos as $key => $value){
                echo "<option value='$value'>$value</option>";
            }
                
        ?>
        </select>
        <br/>
        Zona A<input type="radio" name="zona" value="a"> 
        Zona B<input type="radio" name="zona" value="b">
        Zona C<input type="radio" name="zona" value="c">
        Zona D<input type="radio" name="zona" value="d">
        
        <br/>
        <input type="submit" name="cargaEntradas">
    </form>
    <?php
    if ($cargaEntradas) {
        echo "<form action='' method='POST'>";
        echo "<h3>Equipo seleccionado: $equipoSeleccionado</h3> ";
        $zonaMayuscula = strtoupper($zonaSeleccionada);//zona seleccionada en mayusculas para mejor visibilidad al usuario
        echo "<h3>Zona seleccionada: $zonaMayuscula</h3>";
        echo "<table border='1px'>";
        for ($f=1; $f <= 10 ; $f++) { 
            echo"<tr>";
            for ($c=1; $c <=10 ; $c++) {
                $contador++;
                if (in_array($contador, $arrayAbonados)) {
                    echo "<td id=\"sitioAbonado\">$contador</td>";
                }
                else {
                    echo "<td>";
                    echo $contador;
                    echo " precio entrada: <b>$precioEntrada </b>€";
                echo "<input type=\"checkbox\" name=\"entradas[]\" value=\"$contador\">";
                echo "<input type=\"hidden\" name=\"precioEntrada\" value=\"$precioEntrada\">"; //Así cuando volvamos a enviar el formulario no se pierde el precio de la entrada
                echo "</td>";
                } 
                
            }
            echo "</tr>";
        }
        echo "</table border='1px'>";
        echo" <input type=\"submit\" name=\"calculaPrecio\" value=\"Calcular Precio\">";

        echo"</form>";
    }
    if($cargaPrecioTotal){
        echo "<h3>Precio total: $precioTotal</h3>";
    }
    
    ?>
    

    
    
    
</body>
</html>