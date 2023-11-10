<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../config/conexion.php';

    try {
        $con = new Conexion();
        $sql = $con->getConexion();

        $ubicacionInm = trim($_POST['ubicacion']);
        $descripcionInm = trim($_POST['descripcion']);
        $tamañoInm = trim($_POST['tamaño']);
        $costoInm = trim($_POST['precio']);
        $idInmueble = trim($_POST['id']);

        if (empty($ubicacionInm) || strlen($tamañoInm) == 0 || empty($descripcionInm) || strlen($costoInm) == 0) {
            $response = [
                'success' => false,
                'message' => 'Campos obligatorios incompletos o vacíos.'
            ];

            echo json_encode($response);
            exit;
        }

        $query = "UPDATE inmueble SET ubicacion_inm = '$ubicacionInm', descripcion_inm = '$descripcionInm', tamaño_inm = '$tamañoInm', costo_inm = '$costoInm' WHERE id_inmueble = '$idInmueble'";
        $stmt = $sql->query($query);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Cambios guardados con éxito.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al actualizar el inmueble.'
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
