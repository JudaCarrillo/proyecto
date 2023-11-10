<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

$sql = 'SELECT * FROM cliente';

try {
    $productosQuery = $pdo->query($sql);
    $productos = [];

    while ($producto = $productosQuery->fetch(PDO::FETCH_ASSOC)) {
        $productos[] = [
            'id' => $producto['id_cliente'],
            'nombre' => $producto['nombre_cliente'],
            'email' => $producto['email_cliente'],
            'telf' => $producto['telf_cliente'],
            'dni' => $producto['dni'],
            'fecha' => $producto['fecha_registro'],
        ];
    }

    echo json_encode($productos);
} catch (PDOException $ex) {
    echo json_encode(['error' => 'Error al obtener los datos del cliente']);
}
