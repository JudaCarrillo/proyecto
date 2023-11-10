<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/conexion.php';

    try {
        $con = new Conexion();
        $sql = $con->getConexion();

        $ubicacionTerreno = trim($_POST['ubicacion']);
        $descripcionTerreno = trim($_POST['descripcion']);
        $tamañoTerreno = trim($_POST['tamaño']);
        $costoTerreno = trim($_POST['precio']);
        $idTerreno = trim($_POST['id']);

        if (empty($ubicacionTerreno) || strlen($tamañoTerreno) == 0 || empty($descripcionTerreno) || strlen($costoTerreno) == 0) {
            $response = [
                'success' => false,
                'message' => 'Campos obligatorios incompletos o vacíos.'
            ];

            echo json_encode($response);
            exit;
        }

        $query = "UPDATE terreno SET ubicacion_tem = '$ubicacionTerreno', descripcion_tem = '$descripcionTerreno', tamaño_tem = '$tamañoTerreno', costo_tem = '$costoTerreno' WHERE id_terreno = '$idTerreno'";
        $stmt = $sql->query($query);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Cambios guardados con éxito.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al actualizar el terreno.'
            ];
        }

        echo json_encode($response);
        exit;
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()
        ];
        echo json_encode($response);
        exit;
    }
}
