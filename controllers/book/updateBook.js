var libroId;

$(document).on("click", ".edit-btn", function () {
  libroId = $(this).data("book-id");

  console.log(libroId);

  $.ajax({
    type: "GET",
    url: "../controllers/book/getBookById.php",
    data: { id: libroId },
    dataType: "json",

    success: function (libro) {
      $("#message-edit").addClass("d-none");

      $("input[name='txtEditTitulo']").val(libro.titulo);
      $("input[name='txtEditAutor']").val(libro.autor);
      $("textarea[name='txtEditDescription']").val(libro.descripcion);
      $("input[name='txtEditStock']").val(libro.stock);
      $("input[name='txtEditCosto']").val(libro.costo);

      $("#editModal").modal("show");
    },

    error: function () {
      console.error("Error al obtener datos del libro: " + libroId);
    },
  });
});

$(document).ready(function () {
  $(".edit_book").submit(function (event) {
    event.preventDefault();

    let titulo = $("input[name='txtEditTitulo']").val();
    let autor = $("input[name='txtEditAutor']").val();
    let descripcion = $("textarea[name='txtEditDescription']").val();
    let stock = $("input[name='txtEditStock']").val();
    let costo = $("input[name='txtEditCosto']").val();

    if (
      titulo.trim() === "" ||
      autor.trim() === "" ||
      descripcion.trim() === "" ||
      stock.length == 0 ||
      costo.length == 0
    ) {
      $("#message-register")
        .removeClass("d-none")
        .removeClass("border-success text-success")
        .addClass("border-danger text-danger")
        .text("Campos obligatorios incompletos o vacíos");
      return;
    }

    let datosActualizados = {
      titulo: titulo,
      autor: autor,
      descripcion: descripcion,
      stock: stock,
      costo: costo,
      id: libroId,
    };

    $.ajax({
      type: "POST",
      url: "../controllers/book/updateBook.php",
      data: datosActualizados,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".edit_book")[0].reset();
          $("#editModal").modal("hide");
          window.obtenerLibros();
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
