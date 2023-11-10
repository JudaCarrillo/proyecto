<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/conexion.php';

    try {
        $con = new Conexion();
        $sql = $con->getConexion();

        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $id = trim($_POST['id']);

        if (empty($nombre) || empty($email) || empty($password)) {
            $response = [
                'success' => false,
                'message' => 'Campos obligatorios incompletos o vacíos.'
            ];

            echo json_encode($response);
            exit;
        }

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "UPDATE usuario SET nombre_usu = '$nombre', email_usu = '$email', password_usu = '$password', hash_password_usu = '$password_hash' WHERE id_usu = '$id'";
        $stmt = $sql->query($query);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Cambios guardados con éxito.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al actualizar.'
            ];
        }

        echo json_encode($response);
        exit;
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()
        ];
        echo json_encode($response);
        exit;
    }
}
