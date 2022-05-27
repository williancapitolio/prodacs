<?php
$con = mysqli_connect("localhost", 'root', '', 'prodacs');
if (!$con) {
    die('Not connected : ' . mysqli_connect_error());
}
$id = $_GET['id'];
$endereco = $_GET['description'];

if(empty($id)){
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/user-map.php'>
            <script type=\"text/javascript\">
                alert(\"Nenhum registro encontrado.\");
            </script>
        ";
}

$query_endereco = "SELECT nome, data_nasc, nome_mae, cpf, cpf_chefe FROM pacientes WHERE fam='" . $endereco . "'";
$result_endereco = mysqli_query($con, $query_endereco);

?>

<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Willian Pereira da Silva">

    <title>ProdACS</title>

    <link rel="icon" href="images/favicon.ico">

    <!-- PARA O FUNCIONAMENTO DA NAVBAR -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- PARA O FUNCIONAMENTO DA NAVBAR -->
</head>

<body role="document">

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

    <!-- Fixed navbar -->
    <?php
    include_once 'fixed_navbar.php';
    ?>
    <!-- Fixed navbar -->

    <!-- VERIFICAR SE USUARIO CLICOU POR LINK SEM ESTAR LOGADO -->
    <?php
    if (!empty($_SESSION['id'])) {
        //echo "Olá ".$_SESSION['nome'].", seja bem vindo! ";
        //echo "<a href='sair.php'>Sair</a><br>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Faça o login!</div>";
        header("Location: login.php");
    }
    ?>
    <!-- VERIFICAR SE USUARIO CLICOU POR LINK SEM ESTAR LOGADO -->

    <!-- COMEÇAR DAQUI -->

    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h1>
                        Vizualizar Moradores
                    </h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Nome da Mãe</th>
                            <th>CPF</th>
                            <th>CPF do Chefe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dados = array();
                        while ($row_endereco = mysqli_fetch_array($result_endereco)) {
                            $dado = array();
                            $dado[] = $row_endereco["nome"];
                            $dado[] = $row_endereco["data_nasc"];
                            $dado[] = $row_endereco["nome_mae"];
                            $dado[] = $row_endereco["cpf"];
                            $dado[] = $row_endereco["cpf_chefe"];
                            $dados[] = $dado;
                        ?>
                            <tr>
                                <td><?php echo $row_endereco["nome"]; ?></td>
                                <td><?php echo $row_endereco["data_nasc"]; ?></td>
                                <td><?php echo $row_endereco["nome_mae"]; ?></td>
                                <td><?php echo $row_endereco["cpf"]; ?></td>
                                <td><?php echo $row_endereco["cpf_chefe"]; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
                <?php echo "<a href='vizualizar_marcador.php?description=" . $endereco . "&id=".$id."' class='btn btn-default'><span class='glyphicon glyphicon-arrow-left text-info' aria-hidden='true' style='cursor:pointer;' title='Voltar'></span></a>" ?>
            </div>
        </div>
    </div>

    <!-- FINALIZAR AQUI -->

    <!-- PARA O FUNCIONAMENTO DA NAVBAR -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <!-- PARA O FUNCIONAMENTO DA NAVBAR -->

    <!-- JS PARA APRESENTAR JANELA MODAL PARA APAGAR REGISTROS -->
    <!--
	<script src="js/modal-apagar.js"></script>
	<script src="js/modal-apagar-cal.js"></script>
	-->
    <!-- JS PARA APRESENTAR JANELA MODAL PARA APAGAR REGISTROS -->
</body>

</html>