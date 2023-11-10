var optionLabel;
var cantidad_venta;

$(document).ready(function () {
  var selectProducto = document.getElementById("select-produt");

  // asigna los valores automaticamente
  selectProducto.addEventListener("change", function () {
    var selectedOption = selectProducto.options[selectProducto.selectedIndex];
    optionLabel = selectedOption.textContent;
    var selectedProductId = selectProducto.value;

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
        cantidad_venta = parseInt($("#stock").val());
        costoTotal = costoProducto * cantidad_venta;
        $("#monto").val(costoTotal);

        // actualización en tiempo real del campo monto
        $("#stock").on("input", function () {
          cantidad_venta = parseInt($(this).val());
          costoTotal = costoProducto * cantidad_venta;
          $("#monto").val(costoTotal);
        });

        console.log("Respuesta del servidor: " + response);
      },
      error: function () {
        console.error("Error al realizar la solicitud AJAX.");
      },
    });
  });

  // envia los valores al php para confirmar la compra
  $(".pay-form").submit(function (event) {
    event.preventDefault();

    var monto = $("#monto").val();
    // var cantidad = $("#stock").val();
    var formData = $(this).serializeArray();
    var selectedProductId = selectProducto.value;
    formData.push({ name: "monto", value: monto });
    formData.push({ name: "producto", value: optionLabel });
    formData.push({ name: "cantidad", value: cantidad_venta });
    formData.push({ name: "id_producto", value: selectedProductId });

    console.log("cantidad venta: " + cantidad_venta);

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
