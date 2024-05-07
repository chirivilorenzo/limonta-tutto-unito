<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza</title>
   <!-- Script per jQuery -->
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Script per DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   
    <script src="../js/visualizzaDipendente.js"></script>
    <script src="../js/logout.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" />
  
  <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
  <link rel="stylesheet" href="../CSS/style_table.css">

</head>

<body>
<div id="dataTableContainer">
        <!-- La DataTable verrà inserita qui tramite JavaScript -->
    <table id='myTable' class='display'></table>

</div><br>

<button id="logout">logout</button>

</body>
</html>