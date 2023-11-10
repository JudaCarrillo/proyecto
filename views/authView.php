<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Las Casuarinas</title>
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <!-- unicons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css" />
  <!-- css -->
  <link rel="stylesheet" href="../assets/css/style_login.css" />
</head>

<body>
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3">
              <span>Iniciar Sesión </span><span>Registrarse</span>
            </h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>

            <!-- login  -->
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">

                      <form action="../controllers/auth/login.php" class="form_login" method="post">
                        <h4 class="mb-4 pb-3">Iniciar Sesión</h4>

                        <div id="message-login" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none">
                        </div>

                        <div class="form-group">
                          <input type="text" name="txtUsu" class="form-style" placeholder="Tu nombre" autocomplete="off" required />
                          <i class="input-icon uil uil-user"></i>
                        </div>

                        <div class="form-group mt-2">
                          <input type="password" name="txtPass" class="form-style" placeholder="Tu contraseña" autocomplete="off" required />
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <input type="submit" class="btn mt-4" value="Iniciar Sesión" />

                        <p class="mb-0 mt-4 text-center">
                          <a href="#" class="link">¿Olvidaste tu contraseña?</a>
                        </p>

                      </form>
                    </div>
                  </div>
                </div>

                <!-- registrarse - sign up -->
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">

                      <form action="" class="signup" method="post">
                        <h4 id="signup" class="mb-4 pb-3">Registrarse</h4>

                        <div id="message" class="p pb-2 mb-4 my-4 text-danger border-bottom border-danger d-none">
                        </div>

                        <div class="form-group">
                          <input type="text" name="txtNewUsu" class="form-style" placeholder="Tu nombre" autocomplete="off" required />
                          <i class="input-icon uil uil-user"></i>
                        </div>

                        <div class="form-group mt-2">
                          <input type="email" name="txtNewEmail" class="form-style" placeholder="Tu correo" autocomplete="off" required />
                          <i class="input-icon uil uil-at"></i>
                        </div>

                        <div class="form-group mt-2">
                          <input type="password" name="txtNewPassword" class="form-style" placeholder="Tu contraseña" autocomplete="off" required />
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <input type="submit" class="btn mt-4" value="Registrarse" />

                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- js - login -->
  <script src="../controllers/auth/login.js"></script>

  <!-- js - sign up -->
  <script src="../controllers/auth/signup.js"></script>
</body>

</html>