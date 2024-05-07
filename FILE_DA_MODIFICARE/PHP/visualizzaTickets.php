<?php
include_once("gestioneDB.php");
session_start();
$_SESSION['codiceCliente'] = "gg1234";
$gestioneDB = new gestioneDB();
if (!isset($_SESSION['codiceCliente'])) {
    //header("Location: login.php"); //reindirizza alla pagina di login se l'utente non è autenticato
    exit();
} else {
    $codiceCliente = $_SESSION['codiceCliente'];
    $ticketsStr = $gestioneDB->getTicketCliente($codiceCliente);
    echo $ticketsStr;
}
?>