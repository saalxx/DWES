<?php

$array = [
    1 => "primero",
    3 => "segundo",
    5 => "tercero",
    7 => "cuarto",
    9 => "quinto",
    11 => "sexto",
];

$impar= false;
$par= false;
$sumaDePar = 0;
$sumaDeImpar = 0;
$sumaTotal =0;

foreach ($array as $clave => $valor) {
    if ($valor == "primero" || $valor == "quinto" || $valor == "tercero") {
        $impar=true;
        $sumaDeImpar = $sumaDeImpar + $clave;
        $sumaTotal = $sumaTotal + $clave;
        if($sumaTotal >= 20){
            echo "el valor es mayor que 20 <br>";
        }
        elseif($sumaTotal >= 10){
            echo "el valor es mayor que 10 y menor que 20<br>";
        }
        elseif($sumaTotal > 5){
            echo  "el valor es mayor que 5<br>";
        }
        echo "es numero impar y es $sumaTotal <br> ";
            echo "-----<br>";
    }
    if($valor == "segundo" || $valor == "cuarto" || $valor == "sexto"){
        $par=true;
        $sumaDePar = $sumaDePar + $clave;
        $sumaTotal = $sumaTotal + $clave;
        if($sumaTotal >= 20){
            echo "el valor es mayor que 20 <br>";
        }
        elseif($sumaTotal >= 10){
            echo "el valor es mayor que 10 y menor que 20<br>";
        }
        elseif($sumaTotal > 5){
            echo  "el valor es mayor que 5<br>";
        }
        echo "es numero par y es $sumaTotal <br>  ";
        echo "-----<br>";

    }
}