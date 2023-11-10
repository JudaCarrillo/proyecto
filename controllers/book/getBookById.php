<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    $sql = 'SELECT * FROM libros WHERE id_libro = :id';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $clienteId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $terreno = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($terreno) {
                echo json_encode($terreno);
                exit;
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $ex->getMessage()]);
        exit;
    }
}

echo json_encode(['error' => 'Libro no encontrado']);
