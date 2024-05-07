function esciCliente(){
    $.get("../AJAX/logout.php", {}, function(){
        alert("logout effettuato");
        window.location.href = "../pages/loginCliente.php";
    });
}

function esciDipendente(){
    $.get("../AJAX/logout.php", {}, function(){
        alert("logout effettuato");
        window.location.href = "../pages/loginDipendente.php";
    });
}