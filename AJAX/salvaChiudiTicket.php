<?php
// Inizio della sessione, se non è già stata avviata
if(!isset($_SESSION)){
    session_start();
}
 
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "limonta";
 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
 
$idDipendente = $_SESSION["IDdipendente"];
 
    // Verifica se tutti i campi sono stati inviati correttamente
    if(isset($_POST['idTicket'], $_POST['dataFine'], $_POST['risoluzioneProblema'], $_POST['altro'])) {
        // Recupera i dati inviati dal modulo
        $idTicket = $_POST['idTicket'];
        $dataFine = $_POST['dataFine'];
        $risoluzioneProblema = $_POST['risoluzioneProblema'];
        $altro = $_POST['altro'];
 
        // Prepara e esegui la query per inserire un nuovo record nella tabella chiusuraticket
        $sqlInsertChiusura = "INSERT INTO chiusuraticket (IDticket, IDdipendente, dataFine, risoluzioneProblema, altro) VALUES ('$idTicket', '$idDipendente', '$dataFine', '$risoluzioneProblema', '$altro')";
        if ($conn->query($sqlInsertChiusura) === TRUE) {
            echo "Dettagli di chiusura del ticket salvati con successo.";
        } else {
            echo "Errore durante il salvataggio dei dettagli di chiusura del ticket: " . $conn->error;
        }
 
        $sql = "UPDATE `aperturaticket`
        SET `stato` = 'chiuso'
        WHERE `ID` = '$idTicket'";
        $conn->query($sql);
 
    } else {
        echo "Non tutti i campi sono stati inviati correttamente.";
   }
$conn->close();
?>