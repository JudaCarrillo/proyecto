var inmuebleId;
$(document).on("click", ".edit-btn", function () {
  inmuebleId = $(this).data("state-id");

  console.log(inmuebleId);

  $.ajax({
    type: "GET",
    url: "../controllers/state/getStateById.php",
    data: { id: inmuebleId },
    dataType: "json",

    success: function (inmueble) {
      $("#message-edit").addClass("d-none");

      $("input[name='txtNewUbicationEdit']").val(inmueble.ubicacion_inm);
      $("textarea[name='txtNewDescriptionEdit']").val(inmueble.descripcion_inm);
      $("input[name='txtNewSizeEdit']").val(inmueble.tamaño_inm);
      $("input[name='txtNewPriceEdit']").val(inmueble.costo_inm);

      $("#editModal").modal("show");
    },

    error: function () {
      console.error("Error al obtener datos del cliente: " + inmuebleId);
    },
  });
});

$(document).ready(function () {
  $(".edit_state").submit(function (event) {
    event.preventDefault();

    let ubicacionInm = $("input[name='txtNewUbicationEdit']").val();
    let descripcionInm = $("textarea[name='txtNewDescriptionEdit']").val();
    let tamañoInm = $("input[name='txtNewSizeEdit']").val();
    let precioInm = $("input[name='txtNewPriceEdit']").val();

    if (
      ubicacionInm.trim() === "" ||
      descripcionInm.trim() === "" ||
      tamañoInm.length == 0 ||
      precioInm.length == 0
    ) {
      $("#message-register")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos.");
      return;
    }

    let datosActualizados = {
      ubicacion: ubicacionInm,
      descripcion: descripcionInm,
      tamaño: tamañoInm,
      precio: precioInm,
      id: inmuebleId,
    };

    $.ajax({
      type: "POST",
      url: "../controllers/state/updateState.php",
      data: datosActualizados,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".edit_state")[0].reset();

          $("#message-edit")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);

          $("#editModal").modal("hide");

          window.obtenerInmuebles();
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
