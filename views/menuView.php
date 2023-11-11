<?php
session_start();
include_once '../config/conexion.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$con = new Conexion();
$pdo = $con->getConexion();

$title = "Menú";
$style = "../assets/css/style_menu.css";
$style2 = "../assets/css/style_animaciones.css";
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<body>
    <div class="container-fluid">

        <div class="informacion">
            <h1>Menú</h1>

        </div>

        <div class="dashboard">
            <div class="box inmuebles">
                <i class="fa fa-book"></i>
                <div class="box-content">
                    <div class="box-text">Libros</div>
                    <div class="box-number">
                        <?php
                        try {
                            $sentencia = "SELECT COUNT(*) as total_libros FROM libros;";
                            $query = $pdo->query($sentencia);

                            $resultado = $query->fetch(PDO::FETCH_ASSOC);

                            if ($resultado) {
                                $totalInmuebles = $resultado['total_libros'];
                                echo $totalInmuebles;
                            } else {
                                echo 0;
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- <div class="box terrenos">
                <i class="fas fa-leaf"></i>
                <div class="box-content">
                    <div class="box-text">Terrenos</div>
                    <div class="box-number">
                        <?php
                        /* try {
                            $sentencia = "SELECT COUNT(*) as total_terrenos FROM terreno;";
                            $query = $pdo->query($sentencia);

                            $resultado = $query->fetch(PDO::FETCH_ASSOC);

                            if ($resultado) {
                                $totalTerrenos = $resultado['total_terrenos'];
                                echo $totalTerrenos;
                            } else {
                                echo "0";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        } */
                        ?>
                    </div>
                </div>
            </div> -->

            <div class="box usuarios">
                <i class="fas fa-users"></i>
                <div class="box-content">
                    <div class="box-text">Clientes</div>
                    <div class="box-number">
                        <?php
                        try {
                            $sentencia = "SELECT COUNT(*) as total_clientes FROM cliente;";
                            $query = $pdo->query($sentencia);

                            $resultado = $query->fetch(PDO::FETCH_ASSOC);

                            if ($resultado) {
                                $totalClientes = $resultado['total_clientes'];
                                echo $totalClientes;
                            } else {
                                echo "No se encontraron clientes.";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>