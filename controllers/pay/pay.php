<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../config/conexion.php';

    $con = new Conexion();
    $sql = $con->getConexion();

    $id_product = ($_POST['id_producto']);
    $tipo = ($_POST['producto']);

    if (stripos($tipo, 'Inmueble') !== false) {
        $sentencia = "DELETE FROM inmueble where id_inmueble = :id";
    } else {
        $sentencia = "DELETE FROM terreno where id_terreno = :id";
    }

    try {
        $stmt = $sql->prepare($sentencia);
        $stmt->bindParam(':id', $id_product, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Compra realizada exitosamente!...',
            ];
            echo json_encode($response);
            exit;
        }
        $response = [
            'success' => false,
            'message' => 'Error al realizar la compra.'
        ];
        echo json_encode($response);
        exit;
    } catch (PDOException $ex) {
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $ex->getMessage()]);
        exit;
    }
}
