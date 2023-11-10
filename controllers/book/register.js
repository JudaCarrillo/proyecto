$(document).ready(function () {
  window.obtenerLibros = function () {
    $.ajax({
      type: "GET",
      url: "../controllers/book/getBooks.php",
      dataType: "json",
      success: function (libros) {
        let $tbody = $("table tbody");
        $tbody.empty();

        libros.forEach(function (libro, index) {
          let newRow = "<tr>";

          newRow += "<td>" + (index + 1) + "</td>";
          newRow += "<td>" + libro.titulo + "</td>";
          newRow += "<td>" + libro.autor + "</td>";
          newRow += "<td>" + libro.descripcion + "</td>";
          newRow += "<td>" + libro.stock + "</td>";
          newRow += "<td>" + libro.costo + "</td>";

          newRow +=
            "<td>" +
            '<button id="edit" class="edit-btn z-3 position-relative"  type="button" data-bs-toggle="modal" data-bs-target="#editModal" data-book-id="' +
            libro.id +
            '">' +
            '<i class="bi bi-pencil-square"></i>' +
            "</button>" +
            "</td>";

          newRow +=
            "<td>" +
            '<button id="delete" class="delete-btn z-3 position-relative"  type="button" data-book-id="' +
            libro.id +
            '">' +
            '<i class="bi bi-trash"></i>' +
            "</button>" +
            "</td>";

          newRow += "</tr>";
          $tbody.append(newRow);
        });
      },
      error: function () {
        console.error("Error al obtener los datos de los libros.");
      },
    });
  };

  obtenerLibros();
  //eveto
  $("table tbody").on("click", ".delete-btn", function () {
    let bookId = $(this).data("book-id");

    if (confirm("¿Seguro que deseas eliminar este libro?")) {
      $.ajax({
        type: "POST",
        url: "../controllers/book/deleteBook.php",
        data: { id: bookId },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            obtenerLibros();
          } else {
            console.error("Error al intentar eliminar el libro: " + response.message);
          }
        },
        error: function () {
          console.error("Error en la solicitud AJAX para eliminar el libro.");
        },
      });
    }
  });

  $(".new_book").submit(function (event) {
    event.preventDefault();

    let titulo = $("input[name='txtTitulo']").val();
    let autor = $("input[name='txtAutor']").val();
    let descripcion = $("textarea[name='txtDescription']").val();
    let stock = $("input[name='txtStock']").val();
    let costo = $("input[name='txtCosto']").val();

    if (
      titulo.trim() === "" ||
      autor.trim() === "" ||
      descripcion.trim() === "" ||
      costo.length == 0 ||
      stock.length == 0
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
      url: "../controllers/book/register.php",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".new_book")[0].reset();
          $("#message-register")
            .removeClass("d-none")
            .removeClass("border-danger text-danger")
            .addClass("border-success text-success")
            .text(response.message);

          obtenerLibros();
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
