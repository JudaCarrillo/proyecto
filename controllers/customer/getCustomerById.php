<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    $sql = 'SELECT nombre_cliente, email_cliente, telf_cliente, dni, fecha_registro FROM cliente WHERE id_cliente = :id';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $clienteId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cliente) {
                echo json_encode($cliente);
                exit;
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $ex->getMessage()]);
        exit;
    }
}

echo json_encode(['error' => 'Cliente no encontrado']);
