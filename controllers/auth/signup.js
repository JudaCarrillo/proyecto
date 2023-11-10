$(document).ready(function () {
  $(".signup").submit(function (event) {
    event.preventDefault();

    let nombreUsuario = $("input[name='txtNewUsu']").val();
    let correoUsuario = $("input[name='txtNewEmail']").val();
    let contraseñaUsuario = $("input[name='txtNewPassword']").val();

    if (
      nombreUsuario.trim() === "" ||
      correoUsuario.trim() === "" ||
      contraseñaUsuario.trim() === ""
    ) {
      $("#message")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos");
      return;
    }

    $.ajax({
      type: "POST",
      url: "../controllers/auth/signup.php",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".signup")[0].reset();

          $("#message")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);
        } else {
          $("#message")
            .removeClass("d-none")
            .removeClass("border-success text-success")
            .addClass("border-danger text-danger")
            .text(response.message);
        }
      },
    });
  });
});
