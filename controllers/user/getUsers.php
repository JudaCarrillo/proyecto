<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

$sql = 'SELECT * FROM usuario';

try {
    $usuariosQuery = $pdo->query($sql);
    $usuarios = [];

    while ($usuario = $usuariosQuery->fetch(PDO::FETCH_ASSOC)) {
        $usuarios[] = [
            'id' => $usuario['id_usu'],
            'nombre' => $usuario['nombre_usu'],
            'email' => $usuario['email_usu'],
            'password' => $usuario['password_usu'],
            'password_hash' => $usuario['hash_password_usu']
        ];
    }

    echo json_encode($usuarios);
} catch (PDOException $ex) {
    echo json_encode(['error' => 'Error al obtener los datos de los usuarios']);
}
