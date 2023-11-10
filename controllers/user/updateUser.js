$(document).ready(function () {
  $(".edit-user").submit(function (event) {
    event.preventDefault();

    $("#message-edit").addClass("d-none");

    let nombreUsu = $("input[name='txtUserEdit']").val();
    let emailUsu = $("input[name='txtEmailUserEdit']").val();
    let passUsu = $("input[name='txtPassUserEdit']").val();

    if (
      nombreUsu.trim() === "" ||
      emailUsu.trim() === "" ||
      passUsu.trim === ""
    ) {
      $("#message-edit")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos.");
      return;
    }

    $.ajax({
      type: "POST",
      url: "../controllers/user/updateUser.php",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".edit-user")[0].reset();

          $("#message-edit")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);

          let $table = $("<table>").addClass("w-75 z-3 position-relative");
          let newRow = "";

          newRow += "<tr>";
          newRow += "<td>Nombre:</td>";
          newRow +=
            "<td class='text-center' id='nombre'>" + nombreUsu + "</td>";
          newRow += "</tr>";

          newRow += "<tr>";
          newRow += "<td>Correo:</td>";
          newRow += "<td class='text-center' id='correo'>" + emailUsu + "</td>";
          newRow += "</tr>";

          newRow += "<tr>";
          newRow += "<td>Contraseña:</td>";
          newRow +=
            "<td class='text-center' id='contraseña'>" + passUsu + "</td>";
          newRow += "</tr>";

          $table.append(newRow);

          let $existingTable = $("table");
          $existingTable.replaceWith($table);

          $("#editModal").modal("hide");
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
