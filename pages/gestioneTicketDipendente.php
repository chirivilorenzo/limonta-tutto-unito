<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Ticket Dipendente</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../CSS/style_gestione_ticket.css">
</head>
<body>

<script>

    // Funzione per visualizzare i dettagli del ticket
    function visualizzaTicket() {
        // Recupera l'ID del ticket dalla URL
        var urlParams = new URLSearchParams(window.location.search);
        var idTicket = urlParams.get('idTicket');

        // Effettua la chiamata AJAX per ottenere i dettagli del ticket
        $.get("../AJAX/ottiniDatiTicket.php", { idTicket: idTicket }, function(response) {
            // Aggiorna il contenuto di ticketDetails con i dettagli del ticket ricevuti
            $('#ticketDetails').html(response);
        });
    }

    $(document).ready(function() {
    visualizzaTicket();

    // Evento click per il pulsante "Salva e Chiudi"
    $(document).on('click', '#salva', function(){
        // Recupera i valori dei campi di input
        var dataFine = $("input[name='dataFine']").val();
        var risoluzioneProblema = $("input[name='risoluzioneProblema']").val();
        var altro = $("input[name='altro']").val();

        // Recupera l'ID del ticket dalla URL
        var urlParams = new URLSearchParams(window.location.search);
        var idTicket = urlParams.get('idTicket');

        console.log(dataFine + risoluzioneProblema + altro + idTicket);

        $.post("../AJAX/salvaChiudiTicket.php", { idTicket: idTicket, dataFine: dataFine, risoluzioneProblema: risoluzioneProblema, altro: altro }, function(response) {
            // Visualizza eventuali messaggi di successo o errore
            alert(response);
            window.location.href = "visualizzaDipendente.php";
        });
    });
});


</script>
<div class="container">

<div id="ticketDetails">
    <!-- Qui verranno visualizzati i dettagli del ticket tramite AJAX -->
</div>

</div>
</body>
</html>
