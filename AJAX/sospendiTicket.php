<?php
include_once("gestioneDB.php");
session_start();
$gestioneDB = new gestioneDB();

if(isset($_GET['ticketId'])) {
    $gestioneDB->sospendiTicket($_GET['ticketId']);
    echo "ticket sospeso";
}   
?>