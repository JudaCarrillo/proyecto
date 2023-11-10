<?php
class User
{
    public $nombre;
    public $correo;
    private $contraseña;
    private $hash_contraseña;

    public function __construct($nombre_usu = '', $correo_usu = '', $contraseña_usu = '', $hash_contraseña_usu = '')
    {
        $this->nombre = $nombre_usu;
        $this->correo = $correo_usu;
        $this->contraseña = $contraseña_usu;
        $this->hash_contraseña = $hash_contraseña_usu;
    }

    public function setHashContraseña($contraseña_usu)
    {
        $this->hash_contraseña = $contraseña_usu;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function getHashContraseña()
    {
        return $this->hash_contraseña;
    }
}
