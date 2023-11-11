<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <!-- librería -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- css -->
    <link rel="stylesheet" href="<?php echo $style; ?>">
     
    <!-- css/css alt -->
    <link rel="stylesheet" href="<?php echo $style2; ?>">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- css - template-->
    <link rel="stylesheet" href="../assets/css/style_nav.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/logo.webp" type="image/x-icon">
    <!-- icon's -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


</head>

<body>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="<?php echo $urlInicio; ?>">
                    <i class="fa fa-home nav-icon"></i>
                    <span class="nav-text">Inicio</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $urlLibros; ?>">
                    <i class="fa fa-book nav-icon"></i>
                    <span class="nav-text">Libros</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $urlClientes; ?>">
                    <i class="bi bi-person-fill nav-icon"></i>
                    <span class="nav-text">Clientes</span>
                </a>
            </li>

            <?php
            $nombre_usu = $_SESSION['nombre'];
            if ($nombre_usu === 'Administrador') {
                echo '<li>
                    <a href="' . $urlUsuarios . '">
                    <i class="bi bi-person-bounding-box nav-icon"></i>
                    <span class="nav-text">Usuarios</span>
                    </a>
                    </li>';
            }
            ?>


            <li>
                <a href="<?php echo $urlPagos; ?>">
                    <i class="bi bi-cart-fill nav-icon"></i>
                    <span class="nav-text">Pagos</span>
                </a>
            </li>
        </ul>

        <ul class="logout">
            <li>
                <a href="<?php echo $urlConfig; ?>">
                    <i class="fa fa-cogs nav-icon"></i>
                    <span class="nav-text">Configuración</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $urlLogout; ?>">
                    <i class="fa fa-right-from-bracket nav-icon"></i>
                    <span class="nav-text">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </nav>


    <div class="contenedor">
        <div class="blob-c">
            <div class="shape-blob"></div>
            <div class="shape-blob one"></div>
            <div class="shape-blob two"></div>
            <div class="shape-blob three"></div>
            <div class="shape-blob four"></div>
            <div class="shape-blob five"></div>
            <div class="shape-blob six"></div>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>