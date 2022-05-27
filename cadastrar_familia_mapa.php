<?php
session_start();
ob_start();
include_once("conexao.php");

if (empty($_SESSION['id'])) {
    $_SESSION['msgcad'] = "<div class='alert alert-danger'>Faça o login!</div>";
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
    <title>ProdACS</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-signin" style="background: #42dea4;">
            <h2 class="text-center">Cadastrar Posição no Mapa</h2>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <form method="POST" action="processa_cadastrar_familia_mapa.php">
                <input type="text" name="name" placeholder="Digite o nome do local" class="form-control" required><br>

                <input type="text" name="address" placeholder="Digite o número e o logradouro" class="form-control" required><br>

                <input type="text" name="lat" placeholder="Digite a latitude" class="form-control" required><br>

                <input type="text" name="lng" placeholder="Digite a longitude" class="form-control" required><br>

                <input type="text" name="type" placeholder="Digite o tipo de local" class="form-control" required><br>

                <input type="submit" name="btnCadFamMapa" value="Cadastrar" class="btn btn-success btn-block"><br>

                <div class="row text-center" style="margin-top: 20px;">
                    <a href="mapa.php" class="btn btn-link">Voltar</a>
                </div>


            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>