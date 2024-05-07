$(document).ready(function () {
    mostra_dipendete();
});

function mostra_dipendete() {
    // popolo la DataTable con i valori dei ticket
    $.get("../AJAX/visualizzaDipendente.php", function (response) {
        // verifico che sia avvenuto tutto correttamente
        if (response["status"] == "ok") {
            alert(response["message"]);
        } else {
            alert(response["message"]);
            let data = JSON.parse(response["message"]); // Accesso ai dati dell'oggetto response
            let table = $('#datatable').DataTable();
            table.clear().draw();
            data.forEach(function (item) {
                table.row.add([
                    item.ID,
                    item.IDcliente,
                    item.stato,
                    item.area,
                    item.breveDescrizione,
                    item.dataApertura
                ]).draw();
            });
        }
    }, "json");
}
