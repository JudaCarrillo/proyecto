<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../config/conexion.php';
    require_once '../../models/bookModel.php';

    $con = new Conexion();
    $sql = $con->getConexion();

    $titulo = trim($_POST['txtTitulo']);
    $autor = trim($_POST['txtAutor']);
    $descripcion = trim($_POST['txtDescription']);
    $stock = trim($_POST['txtStock']);
    $costo = trim($_POST['txtCosto']);

    if (empty($titulo) || empty($autor) || empty($descripcion) || strlen($costo) == 0 || strlen($stock) == 0) {
        $response = [
            'success' => false,
            'message' => 'Campos obligatorios incompletos o vacíos.'
        ];

        echo json_encode($response);
        exit;
    }

    $terreno = new Book($titulo, $autor, $descripcion, $stock, $costo);

    $sentencia = $sql->prepare("INSERT INTO libros (titulo, autor, descripcion, stock, costo) VALUES (?, ?, ?, ?, ?)");

    if ($sentencia->execute([$terreno->titulo, $terreno->autor, $terreno->descripcion, $terreno->stock, $terreno->costo])) {
        $response = [
            'success' => true,
            'message' => 'Libro registrado con éxito.',
            'terreno' => [
                'titulo' => $terreno->titulo,
                'autor' => $terreno->autor,
                'descripcion' => $terreno->descripcion,
                'stock' => $terreno->stock,
                'costo' => $terreno->costo,
            ],
        ];
        echo json_encode($response);
        exit;
    } else {
        $response = [
            'success' => false,
            'message' => 'Error al registrar el libro.'
        ];
        echo json_encode($response);
        exit;
    }
}
