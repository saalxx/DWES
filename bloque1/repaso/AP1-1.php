<?php
$datos = $_GET;

foreach ($datos as $clave => $valor) {
    echo "Esto es {$clave}  {$valor} <br>";
}
