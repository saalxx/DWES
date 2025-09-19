<?php
$host = 'mariadb-server';
$username = 'root';
$password = 'root';
$database = 'AP1';

$mysqli = new mysqli($host, $username, $password, $database);

if($mysqli->connect_error){
    die("error de conexion:  " . $mysqli->connect_error);

}
$sql = "SELECT * FROM Usuarios";
$result = $mysqli->query($sql);

while($row = $result->fetch_assoc()) {
    echo "ID; " . $row['id'] . "<br>";
    echo "Nombre; " . $row['nombre'] . "<br>";
    echo "Estado; " . $row['estado'] . "<br>";
    echo "---------<br>";


}
$sql="INSERT INTO Usuarios (nombre, estado) VALUES ('LIONEL','3')";

try{
    $mysqli->query($sql);
    echo"agregado <br>";
}
catch(Exception $e){
    echo "no se puede agregar crack<br>";
}

$sql="Update usuarios set estado = '5'where nombre = 'LIONEL' ";

try{
    $mysqli->query($sql);
    echo "actualizado<br>";
}
catch(Exception $e){
    echo "no se pudo actualizar <br> ".$e->getMessage();
}
$sql = "DELETE from Usuarios where nombre = 'MESSI'";

try {
    $mysqli->query($sql);
    echo "borrado<br>";
}
catch(Exception $e) {
    echo "No se pudo eliminar <br>" . $e->getMessage();
}

$mysqli->close();