<?php
session_start();
include_once '../config/conexion.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$con = new Conexion();
$pdo = $con->getConexion();

$title = "Carrito de Compras";
$style = "../assets/css/style_cart.css";

$urlInicio = "./menuView.php";
$urlLibros = "./bookView.php";
$urlUsuarios = "./userView.php";
$urlClientes = "./customerView.php";
$urlPagos = "./payView.php";
$urlConfig = "./configView.php";
$urlLogout = "../controllers/auth/logout.php";

require_once './templates/temp_nav.php';
?>

<!DOCTYPE html>
<script src="https://www.paypal.com/sdk/js?client-id=Ab3oNN-D3HSub2czSUWgGSNMmKxsssU0NzTb41Ojd2Vn40qrvOlB44n6PeVcivBPpGlkKLD275KeV5gU"></script>

<body>
    <div class="container-fluid">
        <div class="container-form">
            <h1 class="text-center">Formulario de Pagos</h1>

            <div id="message-pay" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>


            <div class="main z-3 position-relative">
                <form method="post" action="../controllers/payment/pay.php" class="pay-form">
                    <div class="form-group mb-3">
                        <label for="nombre" class="mb-1">Nombre del cliente:</label>

                        <select class="form-select" aria-label="Seleccione un terreno">
                            <option selected>Seleccione un cliente</option>

                            <?php
                            $clientesQuery = $pdo->prepare("SELECT * FROM cliente");
                            $clientesQuery->execute();
                            $results = $clientesQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $customer) :
                                $optionLabel = $customer['nombre_cliente'];
                            ?>

                                <option value="<?= $product['id_terreno'] ?>"><?= $optionLabel ?></option>

                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="form-group mb-3">
                        <label for="select-product" class="mb-1">Productos:</label>

                        <select class="form-select" id="select-produt" aria-label="Seleccione un terreno">
                            <option selected>Seleccione un producto</option>

                            <?php
                            $terrenosQuery = $pdo->prepare("SELECT * FROM terreno");
                            $terrenosQuery->execute();
                            $results = $terrenosQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $product) :
                                $optionLabel = "Terreno " . $product['tamaño_tem'] . "m";
                            ?>

                                <option value="<?= $product['id_terreno'] ?>"><?= $optionLabel ?></option>

                            <?php endforeach; ?>

                            <?php
                            $inmueblesQuery = $pdo->prepare("SELECT * FROM inmueble");
                            $inmueblesQuery->execute();
                            $results = $inmueblesQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $product) :
                                $optionLabel = "Inmueble " . $product['tamaño_inm'] . "m";
                            ?>

                                <option value="<?= $product['id_inmueble'] ?>"><?= $optionLabel ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="monto">Monto a Pagar:</label>
                        <input type="number" class="form-control" id="monto" placeholder="Monto a Pagar" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Realizar Pago</button>
                </form>
            </div>


            <div id="paypal-button-container"></div>
        </div>



    </div>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '10.00'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Pago completado con éxito. ID de transacción: ' + details.id);
                });
            }
        }).render('#paypal-button-container');
    </script>

    <!-- js / lógica -->
    <script src="../controllers/pay/logic.js"></script>


</body>

</html>