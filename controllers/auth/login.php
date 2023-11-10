<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/conexion.php';
    $con = new Conexion();
    $sql = $con->getConexion();

    $usuario = trim($_POST['txtUsu']);
    $contraseña = trim($_POST['txtPass']);

    if (empty($usuario) || empty($contraseña)) {
        $response = [
            'success' => false,
            'message' => 'Por favor complete los campos obligatorios'
        ];

        echo json_encode($response);
        exit;
    } else {
        $sentencia = $sql->prepare('SELECT * FROM usuario WHERE nombre_usu = ? LIMIT 1');
        $sentencia->execute([$usuario]);
        $usuario_data = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($usuario_data && password_verify($contraseña, $usuario_data['hash_password_usu'])) {
            $_SESSION['nombre'] = $usuario_data['nombre_usu'];
            $response = [
                'success' => true,
                'message' => 'Iniciando sesión...',
            ];

            echo json_encode($response);
            exit;
        } else {
            $response = [
                'success' => false,
                'message' => 'Error credenciales invalidas'
            ];

            echo json_encode($response);
            exit;
        }
    }
}
