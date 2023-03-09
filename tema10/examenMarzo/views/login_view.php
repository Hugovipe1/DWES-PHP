    <?php
    $arrayClases = ["cuadrado", "circulo", "triangulo"];
    $clase = $arrayClases[array_rand($arrayClases)];
    $arrayVideo = ["https://www.youtube.com/embed/jB-xDvBQuL0", "https://www.youtube.com/embed/GRR8QT2Bpz4", "https://www.youtube.com/embed/rnb0fkpeOao"];
    ?>
    
    <form action="" method="post">
        <label>Usuario: <input type="text" name="usuario"></label><br /><br />
        <label>Password: <input type="password" name="password"></label>
        <?php
            echo "<div class=\"$clase\"></div>";
            echo "<input type=\"hidden\" name=\"claseComprobar\" value=\"$clase\">";
        ?>
        <label>
        <input type="radio" name="figura" value="cuadrado">
        Cuadrado
        </label>
        <label>
        <input type="radio" name="figura" value="circulo">
        Círculo
        </label>
        <label>
        <input type="radio" name="figura" value="triangulo">
        Triángulo
        </label>
        <input type="submit" name="enviar" value="Iniciar Sesión"><br /><br/>
    </form>