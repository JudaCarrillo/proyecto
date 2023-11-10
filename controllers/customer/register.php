<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* inclusión de archivos conexion con la bd y el modelo del cliente */
    require_once '../../config/conexion.php';
    require_once '../../models/customerModel.php';

    /* estableciendo la conexión */
    $con = new Conexion();
    $sql = $con->getConexion();

    /* obteniendo los valores de los campos */
    $nuevoCliente = trim($_POST['txtNewCustomer']);
    $nuevoTelfCliente = trim($_POST['txtNewNumber']);
    $nuevaFchRegCliente = trim($_POST['txtNewDate']);
    $nuevoEmailCliente = trim($_POST['txtNewEmail']);
    $nuevoDniCliente = trim($_POST['txtNewDNI']);

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

    /* creación de objeto cliente usando el model */
    $cliente = new Customer($nuevoCliente, $nuevoEmailCliente, $nuevoTelfCliente, $nuevoDniCliente, $nuevaFchRegCliente);

    /* setencia de validación de cliente existente */
    $sentencia = $sql->prepare("SELECT nombre_cliente FROM cliente WHERE nombre_cliente = ?");
    $sentencia->execute([$cliente->nombre]);

    /* validaciones - cliente existente? | inserción a la bd */
    if ($sentencia->rowCount() > 0) {
        $response = [
            'success' => false,
            'message' => 'El cliente ya existe.',
        ];

        echo json_encode($response);
        exit;
    }

    /* validaciones - imagen */
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    if ($revisar !== false) {
        $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));

        /* inserción */
        $insertar = $sql->query("INSERT INTO cliente (img_cliente, nombre_cliente, email_cliente,telf_cliente, dni, fecha_registro) VALUES ('$imgContenido', '$cliente->nombre', '$cliente->email', '$cliente->telefono', '$cliente->dni', '$cliente->fecha_reg')");

        /* validaciones - inserción correcta? */
        if ($insertar) {
            $response = [
                'success' => true,
                'message' => 'Cliente creado con éxito.',
                'cliente' => [
                    'nombre' => $cliente->nombre,
                    'telefono' => $cliente->telefono,
                    'fecha_reg' => $cliente->fecha_reg,
                ],
            ];
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al registrar el cliente.'
            ];
            echo json_encode($response);
            exit;
        }
    } else {

        $response = [
            'success' => false,
            'message' => 'Por favor seleccione una imagen a subir.',
        ];

        echo json_encode($response);
        exit;
    }
}
