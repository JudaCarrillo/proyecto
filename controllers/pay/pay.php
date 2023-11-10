<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../config/conexion.php';

    $con = new Conexion();
    $sql = $con->getConexion();

    $id_product = ($_POST['id_producto']);
    $tipo = ($_POST['producto']);

    // obtienes la cantidad a comprar
    $cantidad = ($_POST['cantidad']);

    // obtener stock del producto 
    $sentencia_cant_bd = "SELECT stock FROM libros WHERE id_libro = :id";

    $stmt = $sql->prepare($sentencia_cant_bd);
    $stmt->bindParam(':id', $id_product, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $cant_bd = $stmt->fetch(PDO::FETCH_ASSOC)['stock'];
    }

    // validar cantidades a vender
    $cant_rest =  $cant_bd - $cantidad;

    // preparar sentencia
    $sentencia = "UPDATE libros SET stock = '$cant_rest'  where id_libro = :id";

    try {
        $stmt = $sql->prepare($sentencia);
        $stmt->bindParam(':id', $id_product, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Venta realizada exitosamente!...',
            ];
            echo json_encode($response);
            exit;
        }
        $response = [
            'success' => false,
            'message' => 'Error al realizar la venta.'
        ];
        echo json_encode($response);
        exit;
    } catch (PDOException $ex) {
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $ex->getMessage()]);
        exit;
    }
}
