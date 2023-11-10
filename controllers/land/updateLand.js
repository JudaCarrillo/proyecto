var terrenoId;

$(document).on("click", ".edit-btn", function () {
  terrenoId = $(this).data("land-id");

  console.log(terrenoId);

  $.ajax({
    type: "GET",
    url: "../controllers/land/getLandById.php",
    data: { id: terrenoId },
    dataType: "json",

    success: function (terreno) {
      $("#message-edit").addClass("d-none");

      $("input[name='txtNewUbicationEdit']").val(terreno.ubicacion_tem);
      $("textarea[name='txtNewDescriptionEdit']").val(terreno.descripcion_tem);
      $("input[name='txtNewSizeEdit']").val(terreno.tamaño_tem);
      $("input[name='txtNewPriceEdit']").val(terreno.costo_tem);

      $("#editModal").modal("show");
    },

    error: function () {
      console.error("Error al obtener datos del cliente: " + terrenoId);
    },
  });
});

$(document).ready(function () {
  $(".edit_land").submit(function (event) {
    event.preventDefault();

    let ubicacionTerreno = $("input[name='txtNewUbicationEdit']").val();
    let descripcionTerreno = $("textarea[name='txtNewDescriptionEdit']").val();
    let tamañoTerreno = $("input[name='txtNewSizeEdit']").val();
    let precioTerreno = $("input[name='txtNewPriceEdit']").val();

    if (
      ubicacionTerreno.trim() === "" ||
      descripcionTerreno.trim() === "" ||
      tamañoTerreno.length == 0 ||
      precioTerreno.length == 0
    ) {
      $("#message-register")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos");
      return;
    }

    let datosActualizados = {
      ubicacion: ubicacionTerreno,
      descripcion: descripcionTerreno,
      tamaño: tamañoTerreno,
      precio: precioTerreno,
      id: terrenoId,
    };

    $.ajax({
      type: "POST",
      url: "../controllers/land/updateLand.php",
      data: datosActualizados,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".edit_land")[0].reset();

          $("#message-edit")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);

          $("#editModal").modal("hide");

          window.obtenerTerrenos();
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
