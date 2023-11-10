$(document).ready(function () {
  window.obtenerClientes = function () {
    $.ajax({
      type: "GET",
      url: "../controllers/customer/getCustomers.php",
      dataType: "json",
      success: function (clientes) {
        let $tbody = $("table tbody");
        $tbody.empty();

        clientes.forEach(function (cliente, index) {
          let newRow = "<tr>";

          newRow += "<td>" + (index + 1) + "</td>";
          newRow += "<td>" + cliente.nombre + "</td>";
          newRow += "<td>" + cliente.email + "</td>";
          newRow += "<td>" + cliente.telf + "</td>";
          newRow += "<td>" + cliente.dni + "</td>";
          newRow += "<td>" + cliente.fecha + "</td>";

          newRow +=
            "<td>" +
            '<button id="edit" class="edit-btn z-3 position-relative"  type="button" data-bs-toggle="modal" data-bs-target="#editModal" data-customer-id="' +
            cliente.id +
            '">' +
            '<i class="bi bi-pencil-square"></i>' +
            "</button>" +
            "</td>";

          newRow += "</tr>";
          $tbody.append(newRow);
        });
      },
      error: function () {
        console.error("Error al obtener los datos del cliente");
      },
    });
  };

  obtenerClientes();

  $(".new_customer").submit(function (event) {
    event.preventDefault();

    let nombreCliente = $("input[name='txtNewCustomer']").val();
    let emailCliente = $("input[name='txtNewEmail']").val();
    let telfCliente = $("input[name='txtNewNumber']").val();
    let dniCliente = $("input[name='txtNewDNI']").val();
    let fechaRegCliente = $("input[name='txtNewDate']").val();

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

    $.ajax({
      url: "../controllers/customer/register.php",
      type: "POST",
      data: new FormData(this),
      dataType: "json",
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response);
        if (response.success) {
          $(".new_customer")[0].reset();

          $("#message")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);

          obtenerClientes();
        } else {
          $("#message")
            .removeClass("d-none")
            .removeClass("border-success text-success")
            .addClass("border-danger text-danger")
            .text(response.message);
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });
});
