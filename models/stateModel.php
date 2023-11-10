<?php
class State
{
    public $ubicacion;
    public $descripcion;
    public $tamaño;
    public $precio;

    public function __construct($ubicacion_st = '', $descripcion_st = '', $tamaño_st = 0, $precio_st = 0)
    {
        $this->ubicacion = $ubicacion_st;
        $this->descripcion = $descripcion_st;
        $this->tamaño = $tamaño_st;
        $this->precio = $precio_st;
    }
}
