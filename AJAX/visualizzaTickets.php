<?php
include_once("gestioneDB.php");
session_start();

//$_SESSION['IDcliente'] = "1";

$gestioneDB = new gestioneDB();

if (!isset($_SESSION['IDcliente'])) {
    //header("Location: login.php"); //reindirizza alla pagina di login se l'utente non è autenticato
    exit();
}
else {
    $IDcliente = $_SESSION['IDcliente'];
    $ticketsStr = $gestioneDB->getTicketCliente($IDcliente);
    echo $ticketsStr;
}