
function chiudiTicket(ticketId) {
    $.ajax({
        url: "../PHP/chiudiTicket.php",
        method: "GET", // Utilizziamo il metodo POST per inviare dati nel corpo della richiesta
        data: {
            ticketId: ticketId
        },
        success: function(messaggio) {
            alert(messaggio);
            // Aggiorna la pagina o esegui altre azioni necessarie dopo la chiusura del ticket
        },
        error: function(xhr, status, error) {
            console.error("Errore durante la richiesta:", error);
        }
    });
}
function sospendiTicket(ticketId) {
    $.ajax({
        url: "../PHP/sospendiTicket.php",
        method: "GET", // Utilizziamo il metodo POST per inviare dati nel corpo della richiesta
        data: {
            ticketId: ticketId
        },
        success: function(messaggio) {
            alert(messaggio);
            // Aggiorna la pagina o esegui altre azioni necessarie dopo la chiusura del ticket
        },
        error: function(xhr, status, error) {
            console.error("Errore durante la richiesta:", error);
        }
    });
}
$(document).ready(function() {
    $("#visualizzaTicket").click(function () {
        $.ajax({
            url: "../PHP/visualizzaTickets.php",
            method: "GET",
            success: function(data) {
                document.getElementById("divContainer").innerHTML = data;
                //document.getElementById("ris").innerHTML = data;
            },
            error: function(xhr, status, error) {
                console.error("Errore durante la richiesta:", error);
            }
        });
    });   
    
    
});
