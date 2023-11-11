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
$urlCompras = "./buyView.php";
$urlConfig = "./configView.php";
$urlLogout = "../controllers/auth/logout.php";

require_once './templates/temp_nav.php';
?>

<!DOCTYPE html>

<body>
    <div class="container-fluid">
        <div class="container-form">
            <h1 class="text-center">Formulario de Compras</h1>

            <div id="message-pay" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>


            <div class="main z-3 position-relative">
                <form method="post" action="../controllers/buy/buy.php" class="pay-form">
                    <div class="form-group mb-3">
                        <label for="nombre" class="mb-1">Nombre del trabajador:</label>

                        <select class="form-select" aria-label="Seleccione un terreno">
                            <option selected>Seleccione un usuario</option>

                            <?php
                            $nombre_usu = $_SESSION['nombre'];

                            $usuariosQuery = $pdo->prepare("SELECT * FROM usuario");
                            $usuariosQuery->execute();
                            $results = $usuariosQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $user) :
                                $optionLabel = $user['nombre_usu'];
                            ?>

                                <option value="<?= $user['id_usu'] ?>"><?= $optionLabel ?></option>

                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="form-group mb-3">
                        <label for="select-product" class="mb-1">Productos:</label>

                        <select class="form-select" id="select-produt" aria-label="Seleccione un libro">
                            <option selected>Seleccione un producto</option>

                            <?php
                            $terrenosQuery = $pdo->prepare("SELECT * FROM libros");
                            $terrenosQuery->execute();
                            $results = $terrenosQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $product) :
                                $optionLabel = "Libro " . $product['titulo'];
                            ?>

                                <option value="<?= $product['id_libro'] ?>"><?= $optionLabel ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="monto">Cantidad:</label>
                        <input type="number" class="form-control" id="stock" value="1" min="1" placeholder="Cantidad a comprar" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="monto">Monto a Pagar:</label>
                        <input type="number" class="form-control" id="monto" placeholder="Monto a Pagar" required>
                    </div>

                    <div class="mb-3">
                        <input type="date" name="txtNewDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Confirmar Compra</button>
                </form>
            </div>
        </div>



    </div>

    <!-- js / lógica -->
    <script src="../controllers/buy/logic.js"></script>


</body>

</html>