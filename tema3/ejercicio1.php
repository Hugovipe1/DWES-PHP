<?php
$numero1 = 10;
$numero2 = 4;
$numero3 = 4;

if($numero1 > $numero2 && $numero1 > $numero3){
    if($numero2>$numero3){
        echo"$numero1 > $numero2 > $numero3";
    }
    elseif($numero3>$numero2){
        echo"$numero1 > $numero3 > $numero2";
    }
    else{
        echo"$numero1 > $numero3 = $numero2";
    }
}
elseif($numero2 > $numero1 && $numero2 > $numero3){
    if($numero3>$numero1){
        echo"$numero2 > $numero3 > $numero1";
    }
    elseif($numero1>$numero3){
        echo"$numero2 > $numero1 > $numero3";
    }
    else{
        echo"$numero2 > $numero3 = $numero1";
    }
}
elseif ($numero3 > $numero2 && $numero3 > $numero1) {
    if($numero2>$numero1){
        echo"$numero3 > $numero2 > $numero1";
    }
    elseif($numero1>$numero2){
        echo"$numero3 > $numero1 > $numero2";
    }
    else{
        echo"$numero3 > $numero2 = $numero1";
    }
}
else {
    echo"$numero1 = $numero2 = $numero3";
}
?>