<?php

/**
 * @author Hugo Vicente Peligro
 */


include("config/config.php");
include("lib/functions.php");

$muestraFormulario = true;
$cargaEntradas = false;
$cargaPrecioTotal = false;
$precioEntrada = 0;
$mostrarTicket = false;
session_start();


if (isset($_POST["cargaEntradas"])) {
    $_SESSION["equipoSeleccionado"] = $_POST["equipo"];
    if (!empty($_POST["zona"])) {
        $_SESSION["zona"] = $_POST["zona"];
        //Cargamos la primera entrada de esa zona y la última
        foreach ($zonas as $key => $value) {
            if ($value["zona"] == $_SESSION["zona"]) {
                $_SESSION["primeraLocalidad"] = $value["primera_localidad"];
                $_SESSION["ultimaLocalidad"] = $value["ultima_localidad"];
            }
        }
        foreach ($tarifas as $key => $value) {
            if ($value["equipo"] == $_SESSION["equipoSeleccionado"]) {
                foreach ($value["tarifas"] as $key1 => $value1) {
                    if ($value1["zona"] == $_SESSION["zona"]) {
                        $precioEntrada = $value1["precio"];
                    }
                }
            }
        }
        $cargaEntradas = true;
    }
}

if (isset($_POST["calculaPrecio"])) {

    if (isset($_POST["entradas"])) {
        $carritoEquipo = array("equipo" => $_SESSION["equipoSeleccionado"], "zona" => $_SESSION["zona"], "entrada" => array());
        foreach ($carritoEquipo as $key => $value) {
            if ($key == "entrada") {
                foreach ($_POST["entradas"] as $nEntrada => $precio) {
                    if (!in_array($nEntrada, $_SESSION["carrito"])) {
                        $precioEntrada = $precio;
                        $zonaPrecio = array("numero" => $nEntrada, "precio" => $precio);
                        array_push($carritoEquipo["entrada"], $zonaPrecio);
                    }
                }
                $contadorEntrada = count($carritoEquipo["entrada"]);
            }
        }
        array_push($_SESSION["carrito"], $carritoEquipo);
        /*
                    carrito = array(
                                        array("equipo" => pokemon, "zona" => $_SESSION["zona"], "entrada"=> 
                                                                                                    array(array("numero"=>110, "precio"=> 45))
                                        ),
                                        array(),
                                        array(),
                
                                    );
    
                    */
        $cargaPrecioTotal = true;
        $_SESSION["precioTotal"] += $contadorEntrada * $precioEntrada;
    }
}

if (isset($_POST["pagar"])) {
    $muestraFormulario = false;
    $mostrarTicket = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>ExamenFormularios</title>
</head>

<body>
    <div>
        <h1>Venta de entradas del club de baloncesto Pokemons</h1>
    </div>
    <?php
    if ($muestraFormulario) {
        echo "<form action=\"\" method=\"POST\">";

        echo "Partido contra el equipo: ";
    ?>
        <select name="equipo">

        <?php

        foreach ($equipos as $key => $value) {
            if ($value == $_SESSION["equipoSeleccionado"]) {
                echo "<option value='$value' selected>$value</option>";
            } else {
                echo "<option value='$value'>$value</option>";
            }
        }
        echo "</select>";
        echo "<br/>";
        foreach ($zonas as $key => $value) {
            if ($value["zona"] == $_SESSION["zona"]) {
                echo "Zona $value[zona] <input type=\"radio\" name=\"zona\" value=\"$value[zona]\" checked> ";
            } else {
                echo "Zona $value[zona] <input type=\"radio\" name=\"zona\" value=\"$value[zona]\"> ";
            }
        }

        echo "<br/>";
        echo "<input type=\"submit\" name=\"cargaEntradas\" value=\"Muestra Entradas\">";
        echo "</form>";
    }
    if ($cargaEntradas) {
        echo "<form action='' method='POST'>";
        echo "<h3>Equipo seleccionado: $_SESSION[equipoSeleccionado]</h3> ";
        echo "<h3>Zona seleccionada: $_SESSION[zona]</h3>";
        echo "<table border='1px'>";
        for ($f = $_SESSION["primeraLocalidad"]; $f <= $_SESSION["ultimaLocalidad"]; $f++) {
            if (in_array($f, $_SESSION["abonados"])) {
                echo "<span class=\"span\" id=\"sitioAbonado\">$f</span>";
            } else {
                echo "<span class=\"span\">";
                echo $f;
                echo " precio: <b>$precioEntrada </b>€";
                echo "<input type=\"checkbox\" name=\"entradas[$f]\" value=\"$precioEntrada\">"; //SEGUIR EN CASA
                echo "</span>";
            }
            if ($f % NCOLUMNAS == 0) {
                echo "<br/>";
            }
        }

        echo " <input type=\"submit\" name=\"calculaPrecio\" value=\"Calcular Precio\">";
        echo "<input type=\"hidden\" value=\"$precioEntrada\" name=\"precioEntrada\">";
        echo "</form>";
    }
    if ($cargaPrecioTotal) {
        foreach ($_SESSION["carrito"] as $key => $value) {

            echo "<h4>Equipo Seleccionado: $value[equipo]</h1>";
            echo "<h4>Zona seleccionada: $value[zona] </h4>";
            echo "<ul>";
            foreach ($value["entrada"] as $key1 => $value1) {
                echo "<li> Numero: $value1[numero],  Precio: $value1[precio]€</li>";
            }
            echo "</ul>";
        }
        echo "<b>Precio Total</b>: $_SESSION[precioTotal]€";
        echo "<form action=\"\" method=\"post\">";
        echo "<input type=\"submit\" name=\"continuarCompra\"value=\"Seguir comprando\">";
        echo "<input type=\"submit\" name=\"pagar\"value=\"Finalizar Compra\">";

        echo "</form>";
    }

    if ($mostrarTicket) {
        $file = fopen("ticket.txt", "w");
        foreach ($_SESSION["carrito"] as $key => $value) {

            fwrite($file, "Equipo Seleccionado: $value[equipo]\n");
            fwrite($file, "Zona seleccionada: $value[zona]\n");

            foreach ($value["entrada"] as $key1 => $value1) {
                fwrite($file, "Numero: $value1[numero],  Precio: $value1[precio]€ \n");
            }
        }
        fwrite($file, "Precio Total</b>: $_SESSION[precioTotal]€\n");
        echo "<h1>Su compra ha sido realizada con éxito.</h1>";
        echo "<br/> Ticket descargado";
    }
    /*
                    carrito = array(
                                        array("equipo" => pokemon, "zona" => $_SESSION["zona"], "entrada"=> 
                                                                                                    array(array("numero"=>110, "precio"=> 45))
                                        ),
                                        array(),
                                        array(),
                
                                    );
    
                    */

        ?>
        <br /><a href="./logout.php">Salir</a>





</body>

</html>