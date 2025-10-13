<?php
/**
 * @author = fdiaz-alonso
 * Enunciado:
 *
 * Crear una conexión a una BB.DD. de MySQL o MariaDB y extraer los datos de las tablas usuarios y operaciones.
 * Además, añadir en cada una de las tablas un nuevo registro, modificar uno existente y eliminar otro.
 * En este caso la actividad debe hacerse mediante POO
 *
 */

//Instancias iniciales
$db = new Database();
$datos = $db->select("SELECT * FROM usuarios");
foreach ($datos as $value){
    echo "El usuario ".$value["nombre"]." posee la id:".$value["id"]." y su estado es:".$value["estado"]."<br>";
}
$datos = $db->select("SELECT * FROM operaciones");
foreach ($datos as $value){
    //Imporante estamos realizando una select que devuelve un array por lo tanto tenemos que tenerlo encuenta
    $user = $db->select("SELECT nombre FROM usuarios WHERE id=".$value["id_usuarios"]);
    //Al ser un array, no podemos acceder directamente al resultado tenemos una matriz realmente. Por eso será la posición 0.
    echo "La operación con la id: ".$value["id"]." ha obtenido un resultado:".$value["resultado"]." y la ha realizado el usuario:".$user[0]["nombre"]."<br>";
}
$id = $db->insert("INSERT INTO usuarios (nombre, estado) VALUES('Ramona',false)");
echo $id."<br>";
if($db->update_delete("UPDATE usuarios SET estado=true WHERE id=".$id)){
    echo "Se ha realizado correctamente la actualización del usuario id:".$id."<br>";
}
$datos = $db->select("SELECT * FROM usuarios");
foreach ($datos as $value){
    echo "El usuario ".$value["nombre"]." posee la id:".$value["id"]." y su estado es:".$value["estado"]."<br>";
}
if($db->update_delete("DELETE FROM usuarios WHERE id=".$id)){
    echo "Se ha realizado correctamente el borrado del usuario id:".$id."<br>";
}


//Declaración de la clase
class Database
{
    //Establecemos las constantes que se han de utilizar para conectar con la BBDD.
    //Valor para trabajar desde el ordenador
    //private const SERVER = "localhost";
    //Valor para trabajar dentro de docker
    private const SERVER = "172.24.0.2";
    private const USERNAME = "root";
    private const PASSWORD = "root";
    private CONST DB = "AP1";
    //Establecemos también las variables globales de la clase
    private mysqli $conect;

    /**
     * Generamos un constructor que se va a encargar de realizar la instancia con la BBDD
     * y conectarla para poder empezar a trabajar.
     */
    public function __construct()
    {
        //Creamos la conexión a la BB.DD.
        $this->conect = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD, self::DB);
        //Verificamos que no exista ningún error de conexión
        if($this->conect->connect_error){
            //Si la conexión ha fallado detenemos el script y mostramos un aviso.
            die("Conexión fallida: ".$this->conect->connect_errno." --> ".$this->conect->connect_error);
        }
    }

    /**
     * Hay que asegurar que la conexión siempre se finaliza.
     */
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        //Hemos de asegurarnos que la conexión no se queda nunca abierta consumiendo recursos.
        $this->closeConection();
    }

    /**
     * Función que se encarga de cerrar la conexión con la BBDD, evitando el consumo de recursos.
     * @return void
     */
    public function closeConection():void
    {
        $this->conect->close();
    }

    /**
     * En el caso de que trabajemos con otras clases, vease un modelo debemos crear un método que nos permita obtener la conexión.
     * @return mysqli
     */
    public function getConect(): mysqli
    {
        return $this->conect;
    }

    /**
     * Método que a partir de una sentencia se encarga de realziar una busqueda en la BB.DD., insert, etc...
     * @param string $sql
     * @return bool|mysqli_result|null
     */
    private function query(string $sql=null):bool|mysqli_result|null
    {
        if(is_null($sql)){
            //Devolvemos un valor nulo para indicar que no no se ha recibido parámetro de busqueda
            return null;
        }else{
            return $this->conect->query($sql);
        }
    }

    /**
     * A partir de una sentencia nos devuelve todos los valores obtenidos.
     * @param string|null $sql
     * @return mysqli_result|bool
     */
    public function select(string $sql=null):mysqli_result|bool|array
    {
        $result = $this->query($sql);
        if(is_null($result)){
            die ("No se ha recibido la sentencia correctamente<br>");
        }elseif(!$result){
            die ("Se ha producido un fallo realizando la busqueda<br>");
        }else{
            //Verificamos que tengamos o no resultados y devolveremos los resultados o un false
            if($result->num_rows <= 0){
                echo "0 resultados obtenidos";
                $this->closeConection();
                return false;
            }else{
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
    }

    /**
     * @param string|null $sql
     * @return mysqli_result|bool|array
     */
    public function insert(string $sql=null):int
    {
        try {
            $result = $this->query($sql);
            if(is_null($result)){
                die ("No se ha recibido la sentencia correctamente<br>");
            }elseif (!$result){
                die ("Se ha producido un fallo realizando la insercción<br>");
            }else{
                //Se ha realizado la insercción correctamente.
                $id = $this->getConect()->insert_id;
                $this->closeConection();
                echo "Se ha realizado correctamente la insercción con la nueva id:".$id."<br>";
                return $id;
            }
        }catch (mysqli_sql_exception $e){
            die ("Se ha producido el siguiente error:<br>".$e->getMessage().". En la línea:".$e->getLine()."<br>");
        }
    }

    /**
     * Esta función sirve igual para borrar una línea como para actualziarla
     * @param string|null $sql
     * @return bool
     */
    public function update_delete(string $sql=null):bool
    {
        try{
            $result = $this->query($sql);
            $this->closeConection();
            if(is_null($result)){
                die ("No se ha recibido la sentencia correctamente<br>");
            }elseif (!$result){
                die ("Se ha producido un fallo realizando la busqueda<br>");
            }else{
                return true;
            }
        }catch (mysqli_sql_exception $e){
            die ("Se ha producido el siguiente error:<br>".$e->getMessage().". En la línea:".$e->getLine()."<br>");
        }
    }

}

