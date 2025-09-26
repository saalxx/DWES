<?php

    class  DatabaseConnection{
        private static $instancia = null;
        private $host = "mariadb-server";
        private $username = 'root';
        private $password = 'root';
        private $database = 'AP1';
        private $connection;

        private function __construct()
        {
            try {
                $this->connection = new mysqli($this->host, $this->username,$this->password, $this->database);
                echo "Conexion exitosa";
            }
            catch (mysqli_sql_exception $e){
                echo "Error de conexion ".$e->getMessage();
            }
        }
        public static function getInstancia()
        {
            if(self::$instancia === null){
                self::$instancia = new Connection();

            }
            return self::$instancia;
        }
        public function getConnection()
        {
            return $this->connection;
        }
    }
    $instancia1 = Connection::getIntancia();
