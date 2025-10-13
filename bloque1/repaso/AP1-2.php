<?php
$datos = $_GET;

foreach ($datos as $clave => $valor) {
    if ( is_numeric($valor)){
        echo  "el valor que mandaste es numerico {$valor} <br>";

    }
    elseif(is_string($valor)){
        echo " esto es un strings <br>";
    }
    else{
        echo "mandaste un null {$valor} <br>";
    }
    echo "-----<br>";
}
