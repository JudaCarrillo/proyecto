<?php
class Customer
{
    public $nombre;
    public $email;
    public $telefono;
    public $dni;
    public $fecha_reg;

    public function __construct($nombre_cliente = '', $email_cliente = '', $telefono_cliente = 0, $dni_cliente = 0, $fecha_reg_cliente = null)
    {
        $this->nombre = $nombre_cliente;
        $this->email = $email_cliente;
        $this->telefono = $telefono_cliente;
        $this->dni = $dni_cliente;
        $this->fecha_reg = $fecha_reg_cliente;
    }
}
