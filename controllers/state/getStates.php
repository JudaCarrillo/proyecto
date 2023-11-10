<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

$sql = 'SELECT * FROM inmueble';

try {
    $inmueblesQuery = $pdo->query($sql);
    $inmuebles = [];

    while ($inmueble = $inmueblesQuery->fetch(PDO::FETCH_ASSOC)) {
        $inmuebles[] = [
            'id' => $inmueble['id_inmueble'],
            'ubicacion' => $inmueble['ubicacion_inm'],
            'descripcion' => $inmueble['descripcion_inm'],
            'tamaño' => $inmueble['tamaño_inm'],
            'precio' => $inmueble['costo_inm'],
        ];
    }

    echo json_encode($inmuebles);
} catch (PDOException $ex) {
    echo json_encode(['error' => 'Error al obtener los datos del cliente']);
}
