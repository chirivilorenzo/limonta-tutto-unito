<?php
include_once "../constants/constants.php";
if (!isset($_SESSION))
    session_start();
// controllo che l'utente sia loggato
if (!isset($_SESSION[$user_loggato])) {
    // vado alla login 
    // header("Location: ../pages/login.php");
    exit;
}

// sostituisco i segnaposto con le tue informazioni sul database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "limonta";
// creo connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// verifico la connessione
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// query da eseguire
$SELECT = "SELECT * FROM aperturaticket";
$result = $conn->query($SELECT);

$data = array();
$response= array();
// salvo in un array i ticket
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $response['message'] = $data;
    $response['status'] = "ok";
}
else{
    $response['message'] = "errore con l'interrogazione con il db";
    $response['status'] = "ko";
}
// ritorno in json l'array
echo json_encode($data);
$conn->close();
?>