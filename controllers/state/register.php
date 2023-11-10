<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../config/conexion.php';
    require_once '../../models/stateModel.php';

    $con = new Conexion();
    $sql = $con->getConexion();

    $ubicacionInm = trim($_POST['txtNewUbication']);
    $descripcionInm = trim($_POST['txtNewDescription']);
    $tamañoInm = trim($_POST['txtNewSize']);
    $costoInm = trim($_POST['txtNewPrice']);

    if (empty($ubicacionInm) || strlen($tamañoInm) == 0 || empty($descripcionInm) || strlen($costoInm) == 0) {
        $response = [
            'success' => false,
            'message' => 'Campos obligatorios incompletos o vacíos.'
        ];

        echo json_encode($response);
        exit;
    }

    $inmobiliaria = new State($ubicacionInm, $descripcionInm, $tamañoInm, $costoInm);

    $sentencia = $sql->prepare("INSERT INTO inmueble (ubicacion_inm, descripcion_inm, tamaño_inm, costo_inm) VALUES (?, ?, ?, ?)");

    if ($sentencia->execute([$inmobiliaria->ubicacion, $inmobiliaria->descripcion, $inmobiliaria->tamaño, $inmobiliaria->precio])) {
        $response = [
            'success' => true,
            'message' => 'Terreno registrado con éxito.',
            'terreno' => [
                'ubicacion' => $inmobiliaria->ubicacion,
                'descripcion' => $inmobiliaria->descripcion,
                'tamaño' => $inmobiliaria->tamaño,
                'precio' => $inmobiliaria->precio,
            ],
        ];
        echo json_encode($response);
        exit;
    } else {
        $response = [
            'success' => false,
            'message' => 'Error al registrar el producto.'
        ];
        echo json_encode($response);
        exit;
    }
}
