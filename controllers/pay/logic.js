var optionLabel;

$(document).ready(function () {
  var selectProducto = document.getElementById("select-produt");

  selectProducto.addEventListener("change", function () {
    var selectedOption = selectProducto.options[selectProducto.selectedIndex];
    optionLabel = selectedOption.textContent;

    console.log("Etiqueta de opción seleccionada: " + optionLabel);

    var selectedProductId = selectProducto.value;
    console.log("Valor seleccionado de producto: " + selectedProductId);

    $.ajax({
      type: "GET",
      url: "../controllers/pay/getProductById.php",
      data: {
        id: selectedProductId,
        label: optionLabel,
      },
      success: function (response) {
        var responseData = JSON.parse(response);
        var costoProducto = responseData.costo;

        $("#monto").val(costoProducto);

        console.log("Respuesta del servidor: " + response);
      },
      error: function () {
        console.error("Error al realizar la solicitud AJAX.");
      },
    });
  });

  $(".pay-form").submit(function (event) {
    event.preventDefault();

    var monto = $("#monto").val();
    var formData = $(this).serializeArray();
    formData.push({ name: "monto", value: monto });

    formData.push({ name: "producto", value: optionLabel });
    console.log(optionLabel);

    var selectedProductId = selectProducto.value;
    formData.push({ name: "id_producto", value: selectedProductId });

    $.ajax({
      type: "POST",
      url: "../controllers/pay/pay.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".pay-form")[0].reset();
          $("#message-pay")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);
        } else {
          $("#message-pay")
            .removeClass("d-none")
            .removeClass("border-success text-success")
            .addClass("border-danger text-danger")
            .text(response.message);
        }
      },
    });
  });
});
