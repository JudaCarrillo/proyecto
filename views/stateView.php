<?php
session_start();
include_once '../config/conexion.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$con = new Conexion();
$pdo = $con->getConexion();

$title = "Inmuebles";
$style = "../assets/css/style_gen.css";

$urlInicio = "./menuView.php";
$urlInmuebles = "./stateView.php";
$urlTerrenos = "./landView.php";
$urlPagos = "./payView.php";
$urlClientes = "./customerView.php";
$urlConfig = "./configView.php";
$urlLogout = "../controllers/auth/logout.php";

require_once './templates/temp_nav.php';
?>

<!DOCTYPE html>

<body>
    <div class="container-fluid">
        <div class="header">
            <div class="busqueda">
                <input id="search" class="search" type="text" placeholder="Búsqueda" autofocus autocomplete="off">
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
                <h1>Listado de Inmuebles</h1>
                <button type="button" name="btnRegistrar" class="btn btn-primary z-3 position-relative mb-3 my-2" data-bs-toggle="modal" data-bs-target="#registroModal" data-bs-whatever="@mdo">Agregar Inmueble</button>
            </div>

            <div class="table-container table-responsive my-4">
                <table class="table table-striped text-center">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Tamaño</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Opción</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- agregar terrenos modal -->
        <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar inmueble</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="new_state" action="../controllers/state/register.php" method="post" enctype="multipart/form-data">

                            <div id="message-register" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="text" name="txtNewUbication" class="form-control" placeholder="Ubicación del inmueble" required>
                            </div>

                            <div class="mb-3">
                                <label for="txtNewDescription" style="margin-bottom: .2rem; margin-left: .7rem;color: grey">Descripción del inmueble</label>
                                <textarea class="form-control" name="txtNewDescription" style="height: 50px; resize:none" id="txtNewDescription" required>
                                </textarea>
                            </div>

                            <div class=" mb-3">
                                <input type="number" name="txtNewSize" class="form-control" placeholder="Tamaño del inmueble" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtNewPrice" class="form-control" placeholder="Precio del inmueble" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Registrar inmueble</button>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar inmueble</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="edit_state" action="../controllers/state/updateState.php" method="post" enctype="multipart/form-data">

                            <div id="message-edit" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="text" name="txtNewUbicationEdit" class="form-control" placeholder="Ubicación del inmueble" required>
                            </div>

                            <div class="mb-3">
                                <label for="txtNewDescriptionEdit" style="margin-bottom: .2rem; margin-left: .7rem;color: grey">Descripción del inmueble</label>
                                <textarea class="form-control" name="txtNewDescriptionEdit" style="height: 50px; resize:none" id="txtNewDescriptionEdit" required>
                                </textarea>
                            </div>

                            <div class=" mb-3">
                                <input type="number" name="txtNewSizeEdit" class="form-control" placeholder="Tamaño del inmueble" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtNewPriceEdit" class="form-control" placeholder="Precio del inmueble" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Actualizar inmueble</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- js / registrar nuevo inmuebles -->
    <script src="../controllers/state/register.js"></script>
    <!-- js / actualizar inmuebles -->
    <script src="../controllers/state/updateState.js"></script>
    <!-- js - busqueda en tiempo real -->
    <script>
        $(document).ready(function() {
            $("#search").on("input", function() {
                var searchTerm = $(this).val().toLowerCase();


                $("table tbody tr").each(function(index) {
                    var rowData = $(this).find("td");
                    var found = false;

                    rowData.each(function() {
                        if ($(this).text().toLowerCase().indexOf(searchTerm) !== -1) {
                            found = true;
                            return false;
                        }
                    });

                    if (found) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>


</body>


</html>