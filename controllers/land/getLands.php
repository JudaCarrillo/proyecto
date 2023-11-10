<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

$sql = 'SELECT * FROM terreno';

try {
    $terrenosQuery = $pdo->query($sql);
    $terrenos = [];

    while ($terreno = $terrenosQuery->fetch(PDO::FETCH_ASSOC)) {
        $terrenos[] = [
            'id' => $terreno['id_terreno'],
            'ubicacion' => $terreno['ubicacion_tem'],
            'descripcion' => $terreno['descripcion_tem'],
            'tamaño' => $terreno['tamaño_tem'],
            'precio' => $terreno['costo_tem'],
        ];
    }

    echo json_encode($terrenos);
} catch (PDOException $ex) {
    echo json_encode(['error' => 'Error al obtener los datos del cliente']);
}
