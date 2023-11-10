$(document).ready(function () {
  window.obtenerUsuarios = function () {
    $.ajax({
      type: "GET",
      url: "../controllers/user/getUsers.php",
      dataType: "json",
      success: function (usuarios) {
        let $tbody = $("table tbody");
        $tbody.empty();

        usuarios.forEach(function (usuario, index) {
          let newRow = "<tr>";

          newRow += "<td>" + (index + 1) + "</td>";
          newRow += "<td>" + usuario.nombre + "</td>";
          newRow += "<td>" + usuario.email + "</td>";
          newRow += "<td>" + usuario.password + "</td>";

          newRow +=
            "<td>" +
            '<button id="edit" class="edit-btn z-3 position-relative"  type="button" data-bs-toggle="modal" data-bs-target="#editModal" data-user-id="' +
            usuario.id +
            '">' +
            '<i class="bi bi-pencil-square"></i>' +
            "</button>" +
            "</td>";

          newRow += "</tr>";
          $tbody.append(newRow);
        });
      },
      error: function () {
        console.error("Error al obtener los datos de los usuario.");
      },
    });
  };

  obtenerUsuarios();

  $(".signup").submit(function (event) {
    event.preventDefault();

    let nombreUsuario = $("input[name='txtUsu']").val();
    let correoUsuario = $("input[name='txtEmail']").val();
    let contraseñaUsuario = $("input[name='txtPassword']").val();

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
      url: "../controllers/user/register.php",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".signup")[0].reset();

          $("#message-register")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);

          obtenerUsuarios();
        } else {
          $("#message-register")
            .removeClass("d-none")
            .removeClass("border-success text-success")
            .addClass("border-danger text-danger")
            .text(response.message);
        }
      },
    });
  });
});
