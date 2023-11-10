<?php

include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    $sql = 'SELECT id_libro AS id, titulo, autor, descripcion, stock, costo FROM libros WHERE id_libro = :id';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $clienteId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($productData) {
                echo json_encode($productData);
                exit;
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $ex->getMessage()]);
        exit;
    }
}

echo json_encode(['error' => 'Producto no encontrado']);
