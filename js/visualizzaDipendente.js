$(document).ready(function () {

    $("#logout").click(function(){
        esciDipendente();
    });
    
    mostra_dipendente();
});

function mostra_dipendente() {
    $.get("../AJAX/visualizzaDipendente.php", {}, function (data) {
        if (data["status"] == "ok") {
            $("#myTable").html(data.html); // Accedi direttamente a data.html invece di data["html"]
            var table = $('#myTable').DataTable();
            
            // Aggiungi un gestore di eventi clic alla tabella
            $('#myTable tbody').on('click', 'tr', function () {
                // Ottieni i dati della riga cliccata
                var rowData = table.row(this).data();
                
                // Ottieni l'ID dal dato della riga cliccata
                var id = rowData[0]; // Supponendo che l'ID sia nella prima colonna
                
                // Costruisci l'URL della pagina di destinazione
                var url = 'gestioneTicketDipendente.php?idTicket=' + id;
                
                // Reindirizza l'utente alla pagina di destinazione
                window.location.href = url;
            });
        } else {
            alert("Errore: " + data["message"]);
        }
    }, "json");
}
