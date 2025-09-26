<?php
class VehiculoCarrera{
    protected $marca;
    protected $modelo;
    protected $velocidad;
    protected $combustible;

    public function __construct($marca,$modelo,$velocidad,$combustible){
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->velocidad = $velocidad;
        $this->combustible = $combustible;
    }

    public function obtenerCombustible()
    {
        return $this->combustible;
    }

    protected function consumirCombustible(){
        if($this->combustible > 0){
            $this->combustible -= 1;
        }
    }

    public function arrancar()
    {
        if($this->obtenerCombustible() > 2){
            $this->combustible -= 0.25;
            $this->consumirCombustible();
            echo "El coche arrancó<br>";
        }
        else{
            echo "No puedes arrancar ya que no tienes combustible<br>";
        }
    }

    public function acelerar($velocidad)
    {
        if($this->obtenerCombustible() > 10){
            $this->velocidad = $velocidad + 10;
            $this->consumirCombustible();
            echo "Tu velocidad es de $this->velocidad km/h<br>";
        }
    }

    public function detener()
    {
        $this->velocidad = 0;
        echo "Coche detenido<br>";
    }

    public function mostrarEstado()
    {
        echo "Marca: $this->marca, Modelo: $this->modelo, Velocidad: $this->velocidad km/h, Combustible: $this->combustible<br>";
    }

    public function __destruct()
    {
        echo "Coche destruido<br>";
    }
}

class CocheF1 extends VehiculoCarrera{

    private $alerones;

    public function __construct($marca,$modelo,$velocidad,$combustible,$alerones)
    {
        parent::__construct($marca,$modelo,$velocidad,$combustible);
        $this->alerones = $alerones;
    }

    public function activarDRS(){
        $this->velocidad += ($this->velocidad * 0.25);
        echo "DRS activado, nueva velocidad: $this->velocidad km/h<br>";
    }
}

class CocheElectricoF1 extends VehiculoCarrera{
    private $bateria;

    public function __construct($marca,$modelo,$velocidad,$combustible,$bateria){
        parent::__construct($marca,$modelo,$velocidad,$combustible);
        $this->bateria = $bateria;
    }

    public function recargar($recargas)
    {
        foreach ($recargas as $cantidad) {
            $this->bateria += $cantidad;
            if ($this->bateria > 100) {
                $this->bateria = 100;
                break;
            }
        }
        echo "Batería recargada, nivel: $this->bateria%<br>";
    }
}
