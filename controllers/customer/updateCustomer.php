<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once '../../config/conexion.php';

    try {
        $con = new Conexion();
        $sql = $con->getConexion();

        $nuevoCliente = trim($_POST['nombre']);
        $nuevoEmailCliente = trim($_POST['email']);
        $nuevoTelfCliente = trim($_POST['telf']);
        $nuevoDniCliente = trim($_POST['dni']);
        $nuevaFchRegCliente = trim($_POST['fech']);
        $idCliente = trim($_POST['id']);

        /* validaciones - campos vacios? */
        if (empty($nuevoCliente) || strlen($nuevoTelfCliente) == 0 || empty($nuevaFchRegCliente) || empty($nuevoEmailCliente) || strlen($nuevoDniCliente) == 0) {
            $response = [
                'success' => false,
                'message' => 'Campos obligatorios incompletos o vacíos.'
            ];

            echo json_encode($response);
            exit;
        }

        /* validaciones - número de teléfono */
        if (strlen($nuevoTelfCliente) < 9) {
            $response = [
                'success' => false,
                'message' => 'Número de teléfono inválido.'
            ];

            echo json_encode($response);
            exit;
        }

        /* validaciones - número de dni */
        if (strlen($nuevoDniCliente) != 8) {
            $response = [
                'success' => false,
                'message' => 'Número de DNI inválido.'
            ];

            echo json_encode($response);
            exit;
        }

        $query = "UPDATE cliente SET nombre_cliente = '$nuevoCliente', email_cliente = '$nuevoEmailCliente', telf_cliente = '$nuevoTelfCliente', dni = '$nuevoDniCliente', fecha_registro = '$nuevaFchRegCliente' WHERE id_cliente = '$idCliente'";
        $stmt = $sql->query($query);

        if ($stmt->execute()) {
            $response = [
                "success" => true,
                "message" => "Cambios guardados con éxito",
                "cliente" => [
                    'nombre' => $nuevoCliente,
                    'email' => $nuevoEmailCliente,
                    'telf' => $nuevoTelfCliente,
                    'dni' => $nuevoDniCliente,
                    'fech' => $nuevaFchRegCliente
                ]
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al actualizar.'
            ];
        }

        echo json_encode($response);
        exit;
    } catch (PDOException $e) {
        $response = ["success" => false, "message" => "Error al actualizar el producto"];
        echo json_encode($response);
        exit;
    }
}
