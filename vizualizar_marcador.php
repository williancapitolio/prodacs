<?php
$con = mysqli_connect("localhost", 'root', '', 'prodacs');
if (!$con) {
    die('Not connected : ' . mysqli_connect_error());
}
$id = $_GET['id'];
// update location with confirm if admin confirm.
$query = "SELECT * FROM locations WHERE id='" . $_GET['id'] . "'";
$result = mysqli_query($con, $query);

//$endereco = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_NUMBER_INT);
$endereco = $_GET['description'];

if (empty($id)) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/user-map.php'>
            <script type=\"text/javascript\">
                alert(\"Nenhum registro encontrado.\");
            </script>
        ";
}

$query_endereco = "SELECT endereco FROM pacientes WHERE fam='" . $endereco . "'";
$result_endereco = mysqli_query($con, $query_endereco);
$row_endereco = mysqli_fetch_array($result_endereco);

if ($row_endereco == "") {
    $row_endereco['endereco'] = "Não há família vinculada neste endereço!";
}

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
                        Vizualizar Logradouro
                    </h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Família</th>
                            <th>Endereço da Família</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Vizualizar Moradores</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dados = array();
                        while ($row_usuarios = mysqli_fetch_array($result)) {
                            $dado = array();
                            $dado[] = $row_usuarios["id"];
                            $dado[] = $row_usuarios["lat"];
                            $dado[] = $row_usuarios["lng"];
                            $dado[] = $row_usuarios["description"];
                            $dado[] = $row_usuarios["location_status"];
                            $dados[] = $dado;
                        ?>
                            <tr>
                                <td><?php echo $row_usuarios['description']; ?></td>
                                <td><?php echo $row_endereco['endereco']; ?></td>
                                <td><?php echo $row_usuarios['lat']; ?></td>
                                <td><?php echo $row_usuarios['lng']; ?></td>
                                <td>
                                    <?php echo "<a href='vizualizar_marcador_familia.php?description=" . $endereco . "&id=" . $id . "' class='btn btn-default' title='Vizualizar Moradores'><span class='glyphicon glyphicon-home text-info' aria-hidden='true' style='cursor:pointer;'' title='Vizualizar Moradores'</span></a>" ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
                <a href="user-map.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left text-info" aria-hidden="true" style="cursor:pointer;" title="Voltar"></span></a>
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