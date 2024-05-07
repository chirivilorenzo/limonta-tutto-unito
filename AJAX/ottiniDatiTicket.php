<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "limonta";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupera l'ID del ticket dalla richiesta GET
$idTicket = $_GET['idTicket'];

// Query per recuperare i dati del ticket
$sqlTicket = "SELECT * FROM aperturaticket WHERE ID = '$idTicket'";
$resultTicket = $conn->query($sqlTicket);

if ($resultTicket->num_rows > 0) {
    // Recupera i dati del ticket
    $ticket = $resultTicket->fetch_assoc();
    $idCliente = $ticket['IDcliente'];
    $area = $ticket['area'];
    $breveDescrizione = $ticket['breveDescrizione'];
    $descrizione = $ticket['descrizione'];
    $dataApertura = $ticket['dataApertura'];

    // Visualizza i dettagli del ticket
    echo "<h2>Dettagli del Ticket</h2>";
    echo "<p>Codice Cliente: $idCliente</p>";
    echo "<p>Area: $area</p>";
    echo "<p>Breve Descrizione: $breveDescrizione</p>";
    echo "<p>Descrizione: $descrizione</p>";
    echo "<p>Data di Apertura: $dataApertura</p>";

    // Query per recuperare i dipendenti che lavorano sul ticket
    $sqlDipendenti = "SELECT d.nome, d.cognome FROM dipendente d INNER JOIN dipendente_ticket dt ON d.ID = dt.idDipendente WHERE dt.idTicket = $idTicket";
    $resultDipendenti = $conn->query($sqlDipendenti);

    if ($resultDipendenti->num_rows > 0) {
        // Visualizza i dipendenti che lavorano sul ticket
        echo "<h3>Dipendenti che lavorano sul Ticket</h3>";
        echo "<ul>";
        while ($row = $resultDipendenti->fetch_assoc()) {
            echo "<li>" . $row["nome"] . " " . $row["cognome"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nessun dipendente sta lavorando su questo ticket al momento.</p>";
    }

    // Query per recuperare i dettagli di chiusura del ticket
    $sqlChiusura = "SELECT * FROM chiusuraticket WHERE IDticket = $idTicket";
    $resultChiusura = $conn->query($sqlChiusura);

    // Modifica per visualizzare il modulo di chiusura del ticket
    echo "<h2>Dettagli di Chiusura del Ticket</h2>";

    if ($resultChiusura->num_rows > 0) {
        // Se ci sono dettagli di chiusura, precompila il modulo con questi dettagli
        $row = $resultChiusura->fetch_assoc();
        $dataFine = $row["dataFine"];
        $risoluzioneProblema = $row["risoluzioneProblema"];
        $altro = $row["altro"];

        echo "Data di Chiusura: <input type='text' name='dataFine' value='$dataFine'><br>";
        echo "Risoluzione del Problema: <input type='text' name='risoluzioneProblema' value='$risoluzioneProblema'><br>";
        echo "Altro: <input type='text' name='altro' value='$altro'><br>";
    } else {
        // // Se non ci sono dettagli di chiusura, visualizza campi vuoti
        echo "Data di Chiusura: <input type='date' name='dataFine'><br>";
        echo "Risoluzione del Problema: <input type='text' name='risoluzioneProblema'><br>";
        echo "Altro: <input type='text' name='altro'><br>";
        echo "<button id=\"salva\">Salva e Chiudi</button>";
    }

    // Bottone per salvare e chiudere il ticket
    echo "</form>";
} else {
    echo "Nessun ticket trovato con questo ID.";
}

$conn->close();
?>