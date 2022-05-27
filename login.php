<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Willian Pereira da Silva">
    <link rel="icon" href="images/favicon.ico">
    <title>ProdACS</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-signin" style="background: #42dea4;">
            <img src="images/prodacs-logo.png" alt="some text" width=300 height=200>
            <!-- <h2 class="text-center">Login</h2> -->
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            if (isset($_SESSION['msgcad'])) {
                echo $_SESSION['msgcad'];
                unset($_SESSION['msgcad']);
            }
            ?>
            <form method="POST" action="valida.php">
                <!-- <label>Usuário:</label> -->
                <input type="text" name="usuario" placeholder="Digite o nome do usuário" class="form-control"><br>

                <!-- <label>Senha:</label> -->
                <input type="password" name="senha" placeholder="Digite a senha" class="form-control"><br>

                <input type="submit" name="btnLogin" value="Acessar" class="btn btn-success btn-block">

                <div class="row text-center" style="margin-top: 20px;">
                    Sistema fornecido por <b>WPS</b> <br>
                    _________ <br><br>
                    <i>Versão 0.0.1</i>
                </div>

            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>