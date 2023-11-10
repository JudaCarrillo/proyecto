$(document).ready(function () {
  window.obtenerInmuebles = function () {
    $.ajax({
      type: "GET",
      url: "../controllers/state/getStates.php",
      dataType: "json",
      success: function (inmuebles) {
        let $tbody = $("table tbody");
        $tbody.empty();

        inmuebles.forEach(function (inmueble, index) {
          let newRow = "<tr>";

          newRow += "<td>" + (index + 1) + "</td>";
          newRow += "<td>" + inmueble.ubicacion + "</td>";
          newRow += "<td>" + inmueble.descripcion + "</td>";
          newRow += "<td>" + inmueble.tamaño + "</td>";
          newRow += "<td>" + inmueble.precio + "</td>";

          newRow +=
            "<td>" +
            '<button id="edit" class="edit-btn z-3 position-relative"  type="button" data-bs-toggle="modal" data-bs-target="#editModal" data-state-id="' +
            inmueble.id +
            '">' +
            '<i class="bi bi-pencil-square"></i>' +
            "</button>" +
            "</td>";

          newRow += "</tr>";
          $tbody.append(newRow);
        });
      },
      error: function () {
        console.error("Error al obtener los datos del terreno.");
      },
    });
  };

  obtenerInmuebles();

  $(".new_state").submit(function (event) {
    event.preventDefault();

    let ubicacionTerreno = $("input[name='txtNewUbication']").val();
    let descripcionTerreno = $("textarea[name='txtNewDescription']").val();
    let tamañoTerreno = $("input[name='txtNewSize']").val();
    let costoTerreno = $("input[name='txtNewPrice']").val();

    if (
      ubicacionTerreno.trim() === "" ||
      descripcionTerreno.trim() === "" ||
      tamañoTerreno.length == 0 ||
      costoTerreno.length == 0
    ) {
      $("#message-register")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos");
      return;
    }

    $.ajax({
      type: "POST",
      url: "../controllers/state/register.php",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".new_state")[0].reset();
          $("#message-register")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);

          obtenerInmuebles();
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
