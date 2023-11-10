<?php
class Conexion
{
    public function getConexion()
    {
        $host = 'localhost';
        $dbname = 'sistema';
        $user = 'root';
        $pass = '';

        try {
            $conexion_pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        } catch (PDOException $ex) {
            echo "No se logró conectar con la base de datos: $ex";
        }

        return $conexion_pdo;
    }
}
