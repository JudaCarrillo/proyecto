  var usuarioId;

  $(document).on("click", ".edit-btn", function () {
    usuarioId = $(this).data("user-id");

    console.log(usuarioId);

    $.ajax({
      type: "GET",
      url: "../controllers/user/getUserById.php",
      data: { id: usuarioId },
      dataType: "json",

      success: function (usuario) {
        $("#message-edit").addClass("d-none");

        $("input[name='txtEditUsu']").val(usuario.nombre_usu);
        $("input[name='txtEditEmail']").val(usuario.email_usu);
        $("input[name='txtEditPassword']").val(usuario.password_usu);

        $("#editModal").modal("show");
      },

      error: function () {
        console.error("Error al obtener datos del usuario: " + usuarioId);
      },
    });
  });

  $(document).ready(function () {
    $(".edit_user").submit(function (event) {
      event.preventDefault();

      let nombre = $("input[name='txtEditUsu']").val();
      let email = $("input[name='txtEditEmail']").val();
      let password = $("input[name='txtEditPassword']").val();

      if (nombre.trim() === "" || email.trim() === "" || password.trim() === "") {
        $("#message-register")
          .removeClass("d-none")
          .removeClass("border-success text-success")
          .addClass("border-danger text-danger")
          .text("Campos obligatorios incompletos o vacíos");
        return;
      }

      let datosActualizados = {
        nombre: nombre,
        email: email,
        password: password,
        id: usuarioId,
      };

      $.ajax({
        type: "POST",
        url: "../controllers/user/updateUser.php",
        data: datosActualizados,
        dataType: "json",
        success: function (response) {
          if (response.success) {
            $(".edit_user")[0].reset();
            $("#editModal").modal("hide");
            window.obtenerUsuarios();
          } else {
            $("#message-edit")
              .removeClass("d-none")
              .removeClass("border-success text-success")
              .addClass("border-danger text-danger")
              .text(response.message);
          }
        },
        error: function () {
          console.error("Error al realizar la solicitud AJAX.");
        },
      });
    });
  });
