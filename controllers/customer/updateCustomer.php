<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once '../../config/conexion.php';

    $con = new Conexion();
    $sql = $con->getConexion();

    $nuevoCliente = trim($_POST['txtNewCustomerEdit']);
    $nuevoEmailCliente = trim($_POST['txtNewEmailEdit']);
    $nuevoTelfCliente = trim($_POST['txtNewNumberEdit']);
    $nuevoDniCliente = trim($_POST['txtNewDNIEdit']);
    $nuevaFchRegCliente = trim($_POST['txtNewDateEdit']);
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

    /* setencia de validación de cliente existente */
    /* $sentencia = $sql->prepare("SELECT dni FROM cliente WHERE dni = ?");
    $sentencia->execute([$nuevoDniCliente]); */

    /* validaciones - cliente existente? | inserción a la bd */
    /* if ($sentencia->rowCount() > 0) {
        $response = [
            'success' => false,
            'message' => "El DNI $nuevoDniCliente ya está registrado.",
        ];

        echo json_encode($response);
        exit;
    } */

    /* validaciones - imagen */
    $revisar = getimagesize($_FILES["imageEdit"]["tmp_name"]);
    if ($revisar !== false) {
        $image = $_FILES['imageEdit']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));

        /* actualización */
        /* $stmt = $sql->prepare("UPDATE cliente SET img_cliente = :img, nombre_cliente = :nombre, email_cliente = :email, telf_cliente = :telf, dni = :dni, fecha_registro = :fech WHERE id_cliente = :id"); */

        $query = ("UPDATE cliente SET img_cliente = '$imgContenido', nombre_cliente = '$nuevoCliente', email_cliente = '$nuevoEmailCliente', telf_cliente = '$nuevoTelfCliente', dni = '$nuevoDniCliente', fecha_registro = '$nuevaFchRegCliente' WHERE id_cliente = $idCliente");
        $actualizacion = $sql->query($query);

        if ($actualizacion) {
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
            echo json_encode($response);
            exit;
        } else {
            $response = ["success" => false, "message" => "Error al actualizar al cliente"];
            echo json_encode($response);
        }
    } else {

        $stmt = $sql->prepare("UPDATE cliente SET nombre_cliente = :nombre, email_cliente = :email, telf_cliente = :telf, dni = :dni, fecha_registro = :fech WHERE id_cliente = :id");

        $stmt->bindParam(":nombre", $nuevoCliente);
        $stmt->bindParam(":email", $nuevoEmailCliente);
        $stmt->bindParam(":telf", $nuevoTelfCliente);
        $stmt->bindParam(":dni", $nuevoDniCliente);
        $stmt->bindParam(":fech", $nuevaFchRegCliente);
        $stmt->bindParam(":id", $idCliente);


        try {
            $stmt->execute();
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
            echo json_encode($response);
            exit;
        } catch (PDOException $e) {
            $response = ["success" => false, "message" => "Error al actualizar el producto"];
            echo json_encode($response);
        }
    }
} else {
    $response = ["success" => false, "message" => "Solicitud incorrecta"];
    echo json_encode($response);
}
