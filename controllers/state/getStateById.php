<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    $sql = 'SELECT * FROM inmueble WHERE id_inmueble = :id';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $clienteId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $inmueble = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($inmueble) {
                echo json_encode($inmueble);
                exit;
            }
        }
    } catch (PDOException $ex) {
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $ex->getMessage()]);
        exit;
    }
}

echo json_encode(['error' => 'Cliente no encontrado']);
