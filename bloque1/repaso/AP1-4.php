<?php
function calcularAreaTrian($base, $altura) {
    return ($base * $altura) / 2;
}
function calcularAreaRectangulo($base, $altura){
    return ($base * $altura);
}
function calcularCirculo($radio) {
    return pi() * $radio * $radio;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $figura = $_POST['figura'];
    if($figura == "triangulo"){
        $base = $_POST['base'];
        $altura = $_POST['altura'];

        $resultado = calcularAreaTrian($base, $altura);
        echo "Este es tu resultado: $resultado<br>";
    }
    elseif($figura == "rectangulo"){
        $base = $_POST['base'];
        $altura = $_POST['altura'];
        $resultado = calcularAreaRectangulo($base, $altura);
        echo "Este es tu resultado: $resultado<br>";
    }
    else{
        $radio = $_POST['radio'];
        $resultado = calcularCirculo($radio);
        echo "Este es tu resultado: $resultado<br>";

    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
    <label>Figura:</label>
    <select name="figura" required>
        <option value="triangulo">Triángulo</option>
        <option value="rectangulo">Rectángulo</option>
        <option value="circulo">Círculo</option>
    </select>
    <br><br>

    <label>Base:</label>
    <input type="number" name="base" step="any">

    <label>Altura:</label>
    <input type="number" name="altura" step="any">

    <label>Radio:</label>
    <input type="number" name="radio" step="any">
    <br><br>

    <button type="submit">Calcular</button>
</form>

</body>
</html>

