<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Las Casuarinas</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <!-- css -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <!-- FAVICON -->
  <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">

</head>

<body>
  <!-- section home -->
  <section id="home" class="home">
    <div class="home-content">
      <div class="home-logo">
        <img class="lg-emp" src="./assets/img/logo.webp" alt="Logo Las Casuarinas">
        <h1>Las Casuarinas</h1>
        <p>Proyectos Actuales y nuestras ilusiones del futuro</p>
      </div>

      <div class="home-buttons">
        <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</button>
      </div>
    </div>
  </section>

  <!-- modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Iniciar Sesión</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form class="form_login" action="./controllers/auth/login.php" method="post">
            <div id="message-login" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none"></div>

            <div class="mb-3">
              <input type="text" name="txtUsu" class="form-control" placeholder="Tu nombre" required>
            </div>

            <div class="mb-3">
              <input type="password" name="txtPass" class="form-control" placeholder="Tu contraseña" required>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- js / login -->
  <script src="./controllers/auth/login.js"></script>

</body>

</html>