<?php
class Land
{
    public $ubicacion;
    public $descripcion;
    public $tamaño;
    public $precio;

    public function __construct($ubicacion_land = '', $descripcion_land = '', $tamaño_land = 0, $precio_land = 0)
    {
        $this->ubicacion = $ubicacion_land;
        $this->descripcion = $descripcion_land;
        $this->tamaño = $tamaño_land;
        $this->precio = $precio_land;
    }
}
