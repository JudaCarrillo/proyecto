<?php
session_start();
include_once '../config/conexion.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$con = new Conexion();
$pdo = $con->getConexion();

$title = "Libros";
$style = "../assets/css/style_gen.css";
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

<body>
    <div class="container-fluid">
        <div class="header">
            <div class="busqueda">
                <input id="search" class="search" type="text" placeholder="Búsqueda" autofocus autocomplete="FALSE">
                <i id="i-search" class="bi bi-search"></i>
            </div>

            <div class="cart">
                <a class="z-3 position-relative" href="./payView.php">
                    <i id="cart" class="bi bi-cart-fill"></i>
                </a>
            </div>
        </div>

        <div class="main">

            <div class="informacion">
                <h1>Listado de Usuarios</h1>
                <button type="button" name="btnRegistrar" class="button-80 z-3 position-relative mb-3 my-2" data-bs-toggle="modal" data-bs-target="#registroModal" data-bs-whatever="@mdo">Agregar Usuario</button>
            </div>

            <div class="table-container table-responsive my-4">
                <table class="table table-dark text-center">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Opción</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- agregar usuarios modal -->
        <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="signup" action="../controllers/user/register.php" method="post" enctype="multipart/form-data">

                            <div id="message-register" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="text" name="txtUsu" class="form-control" placeholder="Nombre del usuario" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="txtEmail" class="form-control" placeholder="E-mail del usuario" required>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="txtPassword" class="form-control" placeholder="Contraseña del usuario" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Aceptar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- actualizar usuarios - modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="edit_user" action="../controllers/user/updateUser.php" method="post" enctype="multipart/form-data">

                            <div id="message-register" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="text" name="txtEditUsu" class="form-control" placeholder="Nombre del usuario" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="txtEditEmail" class="form-control" placeholder="E-mail del usuario" required>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="txtEditPassword" class="form-control" placeholder="Contraseña del usuario" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Aceptar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>




    <!-- js / registrar usuario -->
    <script src="../controllers/user/register.js"></script>
    <!-- js / actualizar usuario -->
    <script src="../controllers/user/updateUser.js"></script>
    <!-- js - busqueda en tiempo real -->
    <script src="../assets/js/search.js"></script>

</body>


</html>