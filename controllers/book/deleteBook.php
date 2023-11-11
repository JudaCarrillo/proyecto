<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/conexion.php';

    try {
        $con = new Conexion();
        $sql = $con->getConexion();

        $id = trim($_POST['id']);

        $query = "DELETE FROM libros WHERE id_libro = :id";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Libro eliminado con éxito.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al eliminar el libro.'
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
