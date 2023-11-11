<?php
session_start();
include_once '../config/conexion.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$con = new Conexion();
$pdo = $con->getConexion();

$title = "Cofiguración";
$style = "../assets/css/style_conf.css";
$style2 = "../assets/css/style_conf.css";
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

<body>
    <div class="container-fluid">
        <div class="bienvenida">
            <h1 class="text-center">
                Bienvenid@ <?php echo $_SESSION['nombre']; ?>
            </h1>
            <p>Informacion del usuario:</p>
        </div>

        <div class="table-container table-responsive text-start">

            <table class="w-75 z-3 position-relative">
                <?php
                $nombre_usu = $_SESSION['nombre'];
                $cuentaQuery = $pdo->prepare("SELECT * FROM usuario WHERE nombre_usu = :nombre_usu");
                $cuentaQuery->bindParam(':nombre_usu', $nombre_usu);
                $cuentaQuery->execute();
                $results = $cuentaQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $user) :
                ?>
                    <tr>
                        <td>Nombre:</td>
                        <td class="text-center" id="nombre"><?= $user['nombre_usu'] ?></td>
                    </tr>
                    <tr>
                        <td>Correo:</td>
                        <td class="text-center" id="correo"><?= $user['email_usu'] ?></td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td class="text-center" id="contraseña"><?= $user['password_usu'] ?></td>
                    </tr>

                <?php endforeach; ?>
            </table>

            <button type="button" name="btnRegistrar" class="btn btn-small w-25 btn-dark  z-3 position-relative" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="@mdo">Editar</button>
        </div>

        <!-- actualizar usuario - modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="edit-user" action="../controllers/up_user/updateUser.php" method="post" enctype="multipart/form-data">

                            <?php
                            $nombre_usu = $_SESSION['nombre'];
                            $cuentaQuery = $pdo->prepare("SELECT * FROM usuario WHERE nombre_usu = :nombre_usu");
                            $cuentaQuery->bindParam(':nombre_usu', $nombre_usu);
                            $cuentaQuery->execute();
                            $results = $cuentaQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $user) :
                            ?>
                                <div id="message-edit" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                                <div class="mb-3">
                                    <input type="text" name="txtUserEdit" readonly class="form-control" placeholder="Nuevo nombre del usuario" value="<?= $user['nombre_usu'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <input type="email" name="txtEmailUserEdit" class="form-control" placeholder="Nuevo email del usuario" value="<?= $user['email_usu'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <input type="password" name="txtPassUserEdit" class="form-control" placeholder="Nueva contraseña del usuario" value="<?= $user['password_usu'] ?>" required>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
                                </div>

                            <?php endforeach; ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../controllers/up_user/updateUser.js"></script>

</body>

</html>