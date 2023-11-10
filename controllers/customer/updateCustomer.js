var clienteId;

$(document).on("click", ".edit-btn", function () {
  clienteId = $(this).data("customer-id");

  $.ajax({
    type: "GET",
    url: "../controllers/customer/getCustomerById.php",
    data: { id: clienteId },
    dataType: "json",

    success: function (cliente) {
      $("#message-edit").addClass("d-none");

      $("input[name='txtNewCustomerEdit']").val(cliente.nombre_cliente);
      $("input[name='txtNewEmailEdit']").val(cliente.email_cliente);
      $("input[name='txtNewNumberEdit']").val(cliente.telf_cliente);
      $("input[name='txtNewDNIEdit']").val(cliente.dni);
      $("input[name='txtNewDateEdit']").val(cliente.fecha_registro);

      $("#editModal").modal("show");
    },

    error: function () {
      console.error("Error al obtener datos del cliente: " + clienteId);
    },
  });
});

$(document).ready(function () {
  $(".edit-customer").submit(function (event) {
    event.preventDefault();

    let nombreCliente = $("input[name='txtNewCustomerEdit']").val();
    let emailCliente = $("input[name='txtNewEmailEdit']").val();
    let telfCliente = $("input[name='txtNewNumberEdit']").val();
    let dniCliente = $("input[name='txtNewDNIEdit']").val();
    let fechaRegCliente = $("input[name='txtNewDateEdit']").val();

    if (
      nombreCliente.trim() === "" ||
      telfCliente.length == 0 ||
      fechaRegCliente.trim() === "" ||
      emailCliente.trim() === "" ||
      dniCliente.length == 0
    ) {
      $("#message")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos.");
      return;
    }

    if (telfCliente.length < 9) {
      $("#message")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Número de teléfono inválido.");
      return;
    }

    if (dniCliente.length != 8) {
      $("#message")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Número de DNI inválido.");
      return;
    }

    let datosActualizados = {
      nombre: nombreCliente,
      email: emailCliente,
      telf: telfCliente,
      dni: dniCliente,
      fech: fechaRegCliente,
      id: clienteId,
    };

    $.ajax({
      type: "POST",
      url: "../controllers/customer/updateCustomer.php",
      data: datosActualizados,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".edit-customer")[0].reset();
          $("#editModal").modal("hide");
          window.obtenerClientes();
        } else {
          $("#message-edit")
            .removeClass("d-none")
            .removeClass("border-success text-success")
            .addClass("border-danger text-danger")
            .text(response.message);
        }
      },
    });
  });
});
