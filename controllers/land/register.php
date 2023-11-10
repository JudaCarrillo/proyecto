<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../config/conexion.php';
    require_once '../../models/landModel.php';

    $con = new Conexion();
    $sql = $con->getConexion();

    $ubicacionTerreno = trim($_POST['txtNewUbication']);
    $descripcionTerreno = trim($_POST['txtNewDescription']);
    $tamañoTerreno = trim($_POST['txtNewSize']);
    $costoTerreno = trim($_POST['txtNewPrice']);

    if (empty($ubicacionTerreno) || strlen($tamañoTerreno) == 0 || empty($descripcionTerreno) || strlen($costoTerreno) == 0) {
        $response = [
            'success' => false,
            'message' => 'Campos obligatorios incompletos o vacíos.'
        ];

        echo json_encode($response);
        exit;
    }

    $terreno = new Land($ubicacionTerreno, $descripcionTerreno, $tamañoTerreno, $costoTerreno);

    $sentencia = $sql->prepare("INSERT INTO terreno (ubicacion_tem, descripcion_tem, tamaño_tem, costo_tem) VALUES (?, ?, ?, ?)");

    if ($sentencia->execute([$terreno->ubicacion, $terreno->descripcion, $terreno->tamaño, $terreno->precio])) {
        $response = [
            'success' => true,
            'message' => 'Terreno registrado con éxito.',
            'terreno' => [
                'ubicacion' => $terreno->ubicacion,
                'descripcion' => $terreno->descripcion,
                'tamaño' => $terreno->tamaño,
                'precio' => $terreno->precio,
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
