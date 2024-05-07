<html>
    <head>
        <link rel="stylesheet" href="../CSS/style_login.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $("document").ready(function(){
                $("#login").click(function(){
                    verificaUtente();
                });
            });

            function verificaUtente(){
                let user = $("#username").val();
                let psw = $("#password").val();

                $.post("../AJAX/loginCliente.php", {username: user, password: psw}, function(response){
                    if(response["status"] == "200"){
                        window.location.href = "visualizzaTuttoCliente.php";
                    }
                    else{
                        alert(response["status"] + ": " + response["message"]);
                    }
                });
            }
        </script>   
    </head>
    <body>
        <div class="container">
            <div class="input-group">
                <label for="username">Username cliente:</label>
                <input type="text" id="username">
            </div>
            <div class="input-group">
                <label for="password">Password cliente:</label>
                <input type="password" id="password">
            </div>
            <button id="login">Login</button>
        </div>
    </body>
</html>