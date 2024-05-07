<?php
include_once("gestioneDB.php");
session_start();
$gestioneDB = new gestioneDB();

if(isset($_GET['ticketId'])) {
    $gestioneDB->chiudiTicket($_GET['ticketId']);
    echo "ticket chiuso";
}   
?>