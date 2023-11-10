<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/conexion.php';
    require_once '../../models/userModel.php';

    $con = new Conexion();
    $sql = $con->getConexion();

    $nuevoUsuario = trim($_POST['txtUsu']);
    $nuevoCorreo = trim($_POST['txtEmail']);
    $nuevaContraseña = trim($_POST['txtPassword']);

    if (empty($nuevoUsuario) || empty($nuevoUsuario) || empty($nuevaContraseña)) {
        $response = [
            'success' => false,
            'message' => 'Por favor complete los campos obligatorios.'
        ];

        echo json_encode($response);
        exit;
        
    } else {
        $usuario = new User($nuevoUsuario, $nuevoCorreo, $nuevaContraseña);

        $sentencia = $sql->prepare("SELECT nombre_usu FROM usuario WHERE nombre_usu = ?");
        $sentencia->execute([$usuario->nombre]);

        if ($sentencia->rowCount() > 0) {
            $response = [
                'success' => false,
                'message' => 'El usuario ya existe.',
                'usuario' => [
                    'nombre' => $usuario->nombre,
                    'contraseña' => $usuario->getContraseña(),
                    'hash_contraseña' => $usuario->getHashContraseña(),
                ],
            ];

            echo json_encode($response);
            exit;
        } else {
            $usuario->setHashContraseña(password_hash($nuevaContraseña, PASSWORD_BCRYPT));

            $sentencia = $sql->prepare("INSERT INTO usuario (nombre_usu, email_usu, password_usu, hash_password_usu) VALUES (?, ?, ?, ?)");
            if ($sentencia->execute([$usuario->nombre, $usuario->correo, $usuario->getContraseña(), $usuario->getHashContraseña()])) {
                $response = [
                    'success' => true,
                    'message' => 'Usuario creado con éxito.',
                    'usuario' => [
                        'nombre' => $usuario->nombre,
                        'correo' => $usuario->correo,
                        'contraseña' => $usuario->getContraseña(),
                        'hash_contraseña' => $usuario->getHashContraseña(),
                    ],
                ];

                echo json_encode($response);
                exit;
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Error al registrar el usuario.'
                ];
                echo json_encode($response);
                exit;
            }
        }
    }
}
