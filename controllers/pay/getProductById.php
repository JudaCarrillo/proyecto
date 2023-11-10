<?php

include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];
    $product = $_GET['label'];

    if (stripos($product, 'Inmueble') !== false) {
        $sql = 'SELECT id_inmueble AS id, ubicacion_inm AS ubicacion, descripcion_inm AS descripcion, tamaño_inm AS tamaño, costo_inm AS costo FROM inmueble WHERE id_inmueble = :id';
    } else {
        $sql = 'SELECT id_terreno AS id, ubicacion_tem AS ubicacion, descripcion_tem AS descripcion, tamaño_tem AS tamaño, costo_tem AS costo FROM terreno WHERE id_terreno = :id';
    }

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
