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
                <h1>Listado de Libros</h1>
                <button type="button" name="btnRegistrar" class="btn btn-primary z-3 position-relative mb-3 my-2" data-bs-toggle="modal" data-bs-target="#registroModal" data-bs-whatever="@mdo">Agregar Libro</button>
            </div>

            <div class="table-container table-responsive my-4">
                <table class="table table-striped text-center">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Opción</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- agregar libros modal -->
        <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar libro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="new_book" action="../controllers/book/register.php" method="post" enctype="multipart/form-data">

                            <div id="message-register" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="text" name="txtTitulo" class="form-control" placeholder="Título del libro" required>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="txtAutor" class="form-control" placeholder="Autor del libro" required>
                            </div>

                            <div class="mb-3">
                                <label for="txtNewDescription" style="margin-bottom: .2rem; margin-left: .7rem;color: grey">Descripción del libro:</label>
                                <textarea class="form-control" name="txtDescription" style="height: 50px; resize:none" id="txtDescription" required>
                                </textarea>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtStock" class="form-control" placeholder="Cantidad del libro" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtCosto" class="form-control" placeholder="Precio del libro" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Registrar libro</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- actualizar terrenos - modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar libro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="edit_book" action="../controllers/book/updateBook.php" method="post" enctype="multipart/form-data">

                            <div id="message-edit" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="text" name="txtEditTitulo" class="form-control" placeholder="Título del libro" required>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="txtEditAutor" class="form-control" placeholder="Autor del libro" required>
                            </div>

                            <div class="mb-3">
                                <label for="txtNewDescription" style="margin-bottom: .2rem; margin-left: .7rem;color: grey">Descripción del libro:</label>
                                <textarea class="form-control" name="txtEditDescription" style="height: 50px; resize:none" id="txtDescription" required>
                                </textarea>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtEditStock" class="form-control" placeholder="Cantidad del libro" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtEditCosto" class="form-control" placeholder="Precio del libro" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Actualizar libro</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>




    <!-- js / registrar o crear nuevos terrenos -->
    <script src="../controllers/book/register.js"></script>
    <!-- js / actualizar inf. de terrenos -->
    <script src="../controllers/book/updateBook.js"></script>
    <!-- js - busqueda en tiempo real -->
    <script src="../assets/js/search.js"></script>

</body>


</html>