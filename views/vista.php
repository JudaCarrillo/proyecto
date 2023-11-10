<?php
if (!empty($_GET['id'])) {
    $Host = 'localhost';
    $Username = 'root';
    $Password = '';
    $dbName = 'sistema';

    $db = new mysqli($Host, $Username, $Password, $dbName);

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $result = $db->query("SELECT img_cliente FROM cliente WHERE id_cliente = {$_GET['id']}");

    if ($result->num_rows > 0) {
        $imgDatos = $result->fetch_assoc();

        header("Content-type: image/jpg");
        echo $imgDatos['img_cliente'];
    } else {
        echo 'Imagen no existe...';
    }
}
