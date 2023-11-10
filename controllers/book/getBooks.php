<?php
include_once '../../config/conexion.php';
$con = new Conexion();
$pdo = $con->getConexion();

$sql = 'SELECT * FROM libros';

try {
    $librosQuery = $pdo->query($sql);
    $libros = [];

    while ($libro = $librosQuery->fetch(PDO::FETCH_ASSOC)) {
        $libros[] = [
            'id' => $libro['id_libro'],
            'titulo' => $libro['titulo'],
            'autor' => $libro['autor'],
            'descripcion' => $libro['descripcion'],
            'stock' => $libro['stock'],
            'costo' => $libro['costo'],
        ];
    }

    echo json_encode($libros);
} catch (PDOException $ex) {
    echo json_encode(['error' => 'Error al obtener los datos de los libros']);
}
