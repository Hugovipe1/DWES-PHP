<?php
/**
 * @author Hugo Vicente Peligro
 */

 session_start();
 $cartas = array( "1" => "./img/1.jpg", "2" => "./img/2.jpg", "3" => "./img/3.jpg", "4" =>"./img/4.jpg", "5" => "./img/5.jpg", "6" => "./img/6.jpg", "7" => "./img/7.jpg", "8" => "./img/8.jpg", "9" => "./img/9.jpg", "10" => "./img/10.jpg",
  "11" => "./img/11.jpg", "12" => "./img/12.jpg", "13" => "./img/13.jpg", "14" => "./img/14.jpg", "15" => "./img/15.jpg", "16" => "./img/16.jpg", "17" => "./img/17.jpg", "18" => "./img/18.jpg", "19" => "./img/19.jpg", "20" => "./img/20.jpg",
   "21" => "./img/21.jpg", "22" => "./img/22.jpg", "23" => "./img/23.jpg", "24" => "./img/24.jpg", "25" => "./img/25.jpg", "26" => "./img/26.jpg", "27" => "./img/27.jpg", "28" => "./img/28.jpg", "29" => "./img/29.jpg",
  "30" => "./img/30.jpg", "31" => "./img/31.jpg", "32" => "./img/32.jpg", "33" => "./img/33.jpg", "34" => "./img/34.jpg", "35" => "./img/35.jpg", "36" => "./img/36.jpg", "37" => "./img/37.jpg", "38" => "./img/38.jpg", "39" => "./img/39.jpg", "40" => "./img/40.jpg");
    
    $mostrarCartas = false;
    $mostrarGanador = false;
    $mensaje = "";

    $_SESSION["cartas"] = $cartas;
    if (!isset($_SESSION["cartasJugador"])) {
        $_SESSION["cartasJugador"] = array();
        $_SESSION["cartasMaquina"] = array();
        $_SESSION["plantarseJugador"] = false;
        $_SESSION["plantarseMaquina"] = false;
        $_SESSION["contadorJugador"] = 0;
        $_SESSION["contadorMaquina"] = 0;

    }

    if (!isset($_SESSION["dificultadMaquina"])) {
        $_SESSION["dificultadMaquina"] = rand(5,7);
    }

    if(!isset($_COOKIE["numVictorias"])){
        setcookie("numVictorias", 0, time() + 3600);
    }
    if(isset($_POST["iniciarContador"])){
        setcookie("numVictorias", 0, time() + 3600);
        header("Location: index.php");
    }
    if(isset($_POST["nueva"])){
        $mostrarCartas = true;
        if (!$_SESSION["plantarseJugador"]) {
            do { //Primera forma de hacer el contador
                $cartaJugador = array_rand($cartas, 1);
            } while (in_array($cartaJugador, $_SESSION["cartasJugador"]));
            array_push($_SESSION["cartasJugador"], $cartaJugador);
            $_SESSION["contadorJugador"] += ($cartaJugador % 10 > 7 || ($cartaJugador % 10 == 0)) ? 0.5 : ($cartaJugador %10);
            

        }

        if (!$_SESSION["plantarseMaquina"]) {
            do { // Segunda forma de hacer el contador
                $cartaMaquina = array_rand($cartas, 1);
            } while (in_array($cartaMaquina, $_SESSION["cartasMaquina"]));
            array_push($_SESSION["cartasMaquina"], $cartaMaquina);
    
            $contador = 0;
            foreach ($_SESSION["cartasMaquina"] as $key => $value) {
                ($value % 10 > 7 || ($value % 10 == 0)) ? $contador += 0.5 : $contador += ($value%10);
                $_SESSION["contadorMaquina"] = $contador;
                if ($contador > $_SESSION["dificultadMaquina"]) {
                    $_SESSION["plantarseMaquina"] = true; // La máquina se planta
                }
            }
        }
    }

    if (isset($_POST["plantar"])) {
        $_SESSION["plantarseJugador"] = true;

        if (!$_SESSION["plantarseMaquina"]) {
            while (!$_SESSION["plantarseMaquina"]) {
                do {
                    $cartaMaquina = array_rand($cartas, 1);
                } while (in_array($cartaMaquina, $_SESSION["cartasMaquina"]));
                array_push($_SESSION["cartasMaquina"], $cartaMaquina);
        
                $contador = 0;
                foreach ($_SESSION["cartasMaquina"] as $key => $value) {
                    ($value % 10 > 7 || ($value % 10 == 0)) ? $contador += 0.5 : $contador += ($value %10);
                    $_SESSION["contadorMaquina"] = $contador;
                    if ($contador > $_SESSION["dificultadMaquina"]) {
                        $_SESSION["plantarseMaquina"] = true; // La máquina se planta
                    }
                }
            }
        }
        if (($_SESSION["contadorJugador"] < 7.5 && $_SESSION["contadorJugador"] > $_SESSION["contadorMaquina"] )|| ( $_SESSION["contadorJugador"] < 7.5 && $_SESSION["contadorMaquina"] > 7.5 )){
            $mensaje = "Has ganado";
            setcookie("numVictorias", $_COOKIE["numVictorias"] + 1, time() + 3600);
        }
        elseif (($_SESSION["contadorMaquina"] < 7.5 && $_SESSION["contadorMaquina"] > $_SESSION["contadorJugador"] )|| ( $_SESSION["contadorMaquina"] < 7.5 && $_SESSION["contadorJugador"] > 7.5 )){
            $mensaje = "Has perdido, ha ganado la máquina";
        }

        elseif ($_SESSION["contadorJugador"] == $_SESSION["contadorMaquina"]) {
            $mensaje = "Empate";
        }
         elseif ($_SESSION["contadorJugador"] > 7.5 && $_SESSION["contadorMaquina"] > 7.5) {
            $mensaje = "Habeis perdidos los dos";
        }
        

        $mostrarGanador = true;
        

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Hugo Vicente Peligro</title>
</head>
<body>
    <form action="" method="POST">
        <input type="submit" value="Nueva Carta" name="nueva">
        <input type="submit" value="Plantar" name="plantar">
        <input type="submit" value="Iniciar Contador" name="iniciarContador">
    </form>
    <a href="./cierreSesion.php">Nueva Partida</a>
    <div>
        <h1>Las 7 y 1/2</h1>
        <h2>Numero de victorias: <?php echo $_COOKIE["numVictorias"]?></h2> 
        

        
        <?php
            echo "<h3>Cartas del jugador</h3>";
            if ($mostrarCartas) {
                echo "<p>Puntuación: $_SESSION[contadorJugador]</p>";
            }
            echo "<div>";
            foreach ($_SESSION["cartasJugador"] as $key => $value) {
                
                echo "<img src='" . $_SESSION["cartas"][$value]."' alt='Carta'>";
            }
            echo "</div>";

            echo "<h3>Cartas de la máquina</h3>";
            echo "<div>";
            foreach ($_SESSION["cartasMaquina"] as $key => $value) {
                echo "<img src=\"./img/reverso.jpg\" alt='Carta'>";
            }
            echo "</div>";
        ?>

        <?php
            if ($mostrarGanador) {
                echo "<h2>$mensaje</h2>";
                echo "<p>Puntuación del jugador: $_SESSION[contadorJugador]</p>";
                echo "<p>Puntuación de la máquina: $_SESSION[contadorMaquina]</p>";
                echo "<h3>Cartas de la máquina</h3>";
                foreach ($_SESSION["cartasMaquina"] as $key => $value) {
                    echo "<img src='" . $_SESSION["cartas"][$value]."' alt='Carta'>";
                }
            }

        ?>

    
    
</body>
</html>