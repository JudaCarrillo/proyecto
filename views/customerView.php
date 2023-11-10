<?php
session_start();
include_once '../config/conexion.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$con = new Conexion();
$pdo = $con->getConexion();

$title = "Clientes";
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
                <h1>Listado de Clientes</h1>
                <button type="button" name="btnRegistrar" class="btn btn-primary z-3 position-relative mb-3 my-2" data-bs-toggle="modal" data-bs-target="#registroModal" data-bs-whatever="@mdo">Agregar Cliente</button>
            </div>

            <div class="table-container table-responsive my-4">
                <table class="table table-striped text-center">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Opción</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- agregar clientes - modal -->
        <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear cuenta nueva</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="new_customer" action="../controllers/customer/register.php" method="post" enctype="multipart/form-data">

                            <div id="message" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="file" class="form-control" name="image" id="image" multiple />
                            </div>

                            <div class="mb-3">
                                <input type="text" name="txtNewCustomer" class="form-control" placeholder="Nombre del cliente" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="txtNewEmail" class="form-control" placeholder="Email del cliente" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtNewNumber" class="form-control" placeholder="Núm. de teléfono" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtNewDNI" class="form-control" placeholder="DNI" required>
                            </div>

                            <div class="mb-3">
                                <input type="date" name="txtNewDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Crear cuenta</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- actualizar clientes - modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Ciente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form class="edit-customer" action="../controllers/customer/updateCustomer.php" method="post" enctype="multipart/form-data">

                            <div id="message-edit" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

                            <div class="mb-3">
                                <input type="file" class="form-control" name="imageEdit" id="image" multiple />
                            </div>

                            <div class="mb-3">
                                <input type="text" name="txtNewCustomerEdit" class="form-control" placeholder="Nombre del cliente" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="txtNewEmailEdit" class="form-control" placeholder="Email del cliente" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtNewNumberEdit" class="form-control" placeholder="Núm. de teléfono" required>
                            </div>

                            <div class="mb-3">
                                <input type="number" name="txtNewDNIEdit" class="form-control" placeholder="DNI" required>
                            </div>

                            <div class="mb-3">
                                <input type="date" name="txtNewDateEdit" class="form-control" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- js - registro de nuevos clientes / actualización de tabla -->
    <script src="../controllers/customer/register.js"></script>
    <!-- js - edición / actualización de clientes -->
    <script src="../controllers/customer/updateCustomer.js"></script>

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