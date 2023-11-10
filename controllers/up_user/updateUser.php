<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    require_once '../../config/conexion.php';

    try {

        $con = new Conexion();
        $sql = $con->getConexion();

        $nameUser = trim($_POST['txtUserEdit']);
        $emailUser = trim($_POST['txtEmailUserEdit']);
        $passwordUser = trim($_POST['txtPassUserEdit']);

        $nombre_usu = $_SESSION['nombre'];
        $cuentaQuery = $sql->prepare("SELECT id_usu FROM usuario WHERE nombre_usu = :nombre_usu");
        $cuentaQuery->bindParam(':nombre_usu', $nombre_usu);
        $cuentaQuery->execute();

        $id_usuario = $cuentaQuery->fetchColumn();

        if (empty($nameUser) || empty($emailUser) || empty($passwordUser)) {
            $response = [
                'success' => false,
                'message' => 'Campos obligatorios incompletos o vacíos.'
            ];

            echo json_encode($response);
            exit;
        }

        $hashPasswordUsu = password_hash($passwordUser, PASSWORD_BCRYPT);

        $query = "UPDATE usuario SET nombre_usu = '$nameUser', email_usu = '$emailUser', password_usu = '$passwordUser', hash_password_usu = '$hashPasswordUsu' WHERE id_usu = '$id_usuario'";
        $stmt = $sql->query($query);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Cambios guardados con éxito.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al actualizar el terreno.'
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
