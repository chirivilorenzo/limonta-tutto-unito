<?php
if (!isset($_SESSION)) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "limonta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$SELECT = "SELECT * FROM aperturaticket";
$result = $conn->query($SELECT);

$data = array();
$response["status"] = "ok"; // Aggiunto stato di risposta
$response["message"] = ""; // Aggiunto messaggio di risposta

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $html = "";
    $html .= "<thead><tr><th>ID</th><th>ID Cliente</th><th>Stato</th><th>Area</th><th>Breve Descrizione</th><th>Data Apertura</th></tr></thead>";
    $html .= "<tbody>";
    foreach ($data as $row) {
        $html .= "<tr>";
        $html .= "<td>" . $row['ID'] . "</td>";
        $html .= "<td>" . $row['IDcliente'] . "</td>";
        $html .= "<td>" . $row['stato'] . "</td>";
        $html .= "<td>" . $row['area'] . "</td>";
        $html .= "<td>" . $row['breveDescrizione'] . "</td>";
        $html .= "<td>" . $row['dataApertura'] . "</td>";
        $html .= "</tr>";
    }
    $html .= "</tbody>";
    $response["html"] = $html; // Aggiunto HTML alla risposta
} else {
    $response["status"] = "ko"; // Aggiunto stato di risposta nel caso di nessun dato trovato
    $response["message"] = "Nessun dato trovato"; // Aggiunto messaggio di risposta
}

echo json_encode($response); // Codifica la risposta come JSON

$conn->close();
?>