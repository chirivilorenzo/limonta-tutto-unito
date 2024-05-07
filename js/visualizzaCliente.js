$(document).ready(function() {

    $("#logout").click(function(){
        esciCliente();
    });

    $("#aggiungiTicketCliente").click(function(){
        window.location.href = "../pages/inserisciCliente.php";
    });

    caricaTickets();
});

function caricaTickets(){
    $.ajax({
        url: "../AJAX/visualizzaTickets.php",
        method: "GET",
        success: function(data) {
            document.getElementById("divContainer").innerHTML = data;
            //document.getElementById("ris").innerHTML = data;
        },
        error: function(xhr, status, error) {
            console.error("Errore durante la richiesta:", error);
        }
    });
}

function chiudiTicket(ticketId) {
    $.ajax({
        url: "../AJAX/chiudiTicket.php",
        method: "GET", // Utilizziamo il metodo POST per inviare dati nel corpo della richiesta
        data: {
            ticketId: ticketId
        },
        success: function(messaggio) {
            alert(messaggio);
            caricaTickets();
        },
        error: function(xhr, status, error) {
            console.error("Errore durante la richiesta:", error);
        }
    });
}

function sospendiTicket(ticketId) {
    $.ajax({
        url: "../AJAX/sospendiTicket.php",
        method: "GET", // Utilizziamo il metodo POST per inviare dati nel corpo della richiesta
        data: {
            ticketId: ticketId
        },
        success: function(messaggio) {
            alert(messaggio);
            caricaTickets();
        },
        error: function(xhr, status, error) {
            console.error("Errore durante la richiesta:", error);
        }
    });
}
