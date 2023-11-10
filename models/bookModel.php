<?php
class Book
{
    public $titulo;
    public $autor;
    public $descripcion;
    public $stock;
    public $costo;

    public function __construct($titulo_libro = '', $autor_libro = '', $descripcion_libro = '', $stock_libro = 0, $costo_libro = 0)
    {
        $this->titulo = $titulo_libro;
        $this->autor = $autor_libro;
        $this->descripcion = $descripcion_libro;
        $this->stock = $stock_libro;
        $this->costo = $costo_libro;
    }
}
