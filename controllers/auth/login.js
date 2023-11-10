$(document).ready(function () {
  $(".form_login").submit(function (event) {
    event.preventDefault();

    let nombreUsuario = $("input[name='txtUsu']").val();
    let contraseñaUsuario = $("input[name='txtPass']").val();

    if (nombreUsuario.trim() === "" || contraseñaUsuario.trim() === "") {
      $("#message-login")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos");
      return;
    }

    $.ajax({
      type: "POST",
      url: "../controllers/auth/login.php",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".form_login")[0].reset();
          $("#message-login")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);
          window.location = "menuView.php";
        } else {
          $("#message-login")
            .removeClass("d-none")
            .removeClass("border-success text-success")
            .addClass("border-danger text-danger")
            .text(response.message);
        }
      },
    });
  });
});
