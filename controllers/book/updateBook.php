<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/conexion.php';

    try {
        $con = new Conexion();
        $sql = $con->getConexion();

        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $descripcion = trim($_POST['descripcion']);
        $stock = trim($_POST['stock']);
        $costo = trim($_POST['costo']);
        $id = trim($_POST['id']);

        if (empty($titulo) || empty($autor) || empty($descripcion) || strlen($stock) == 0 || strlen($costo) == 0) {
            $response = [
                'success' => false,
                'message' => 'Campos obligatorios incompletos o vacíos.'
            ];

            echo json_encode($response);
            exit;
        }

        $query = "UPDATE libros SET titulo = '$titulo', autor = '$autor', descripcion = '$descripcion', stock = '$stock', costo = '$costo' WHERE id_libro = '$id'";
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
