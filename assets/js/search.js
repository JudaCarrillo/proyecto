$(document).ready(function() {
    $("#search").on("input", function() {
        var searchTerm = $(this).val().toLowerCase();


        $("table tbody tr").each(function(index) {
            var rowData = $(this).find("td");
            var found = false;

            rowData.each(function() {
                if ($(this).text().toLowerCase().indexOf(searchTerm) !== -1) {
                    found = true;
                    return false;
                }
            });

            if (found) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});