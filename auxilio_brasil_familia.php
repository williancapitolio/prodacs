<?php

include_once("conexao.php");

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/auxilio_brasil.php'>
            <script type=\"text/javascript\">
                alert(\"Nenhum registro encontrado.\");
            </script>
        ";
}

$fam_abf = filter_input(INPUT_GET, 'fam_ab', FILTER_SANITIZE_NUMBER_INT);

$query_endereco = "SELECT id, fam, nome, data_nasc, nome_mae, data_coleta, peso, altura FROM pacientes where fam='$fam_abf'";
$result_endereco = mysqli_query($conn, $query_endereco);
//$row_endereco = mysqli_fetch_array($result_endereco);
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
                        Auxílio Brasil - Família
                    </h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Nome da Mãe</th>
                            <th>Data da Coleta</th>
                            <th>Peso</th>
                            <th>Altura</th>
                            <th>Inserir</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //$dados = array();
                        while ($row_endereco = mysqli_fetch_array($result_endereco)) {
                            /*$dado = array();
                            $dado = $row_endereco['id'];
                            $dado = $row_endereco['nome'];
                            $dado = $row_endereco['data_nasc'];
                            $dado = $row_endereco['nome_mae'];
                            $dado = $row_endereco['data_coleta'];
                            $dado = $row_endereco['peso'];
                            $dado = $row_endereco['altura'];
                            $dados[] = $dado;*/
                        ?>
                            <tr>
                                <td style="display: none;"><?php echo $row_endereco['id']; ?></td>
                                <td><?php echo $row_endereco['nome']; ?></td>
                                <td><?php echo $row_endereco['data_nasc']; ?></td>
                                <td><?php echo $row_endereco['nome_mae']; ?></td>
                                <th><?php echo $row_endereco['data_coleta']; ?></th>
                                <th><?php echo $row_endereco['peso']; ?></th>
                                <th><?php echo $row_endereco['altura']; ?></th>
                                <td>
                                    <!--
                                        auxilio_brasil_familia_editar.php?id=" . $id . "&fam_ab=" . $fam_abf . "&nome=" . $row_endereco['nome'] . "&data_nasc=" . $row_endereco['data_nasc'] . "&nome_mae=" . $row_endereco['nome_mae'] . "
                                     -->
                                    <!--
                                        BOTÃO ESTÁ NO WHATSAPP
                                    -->

                                    <?php
                                    //echo "<a href='auxilio_brasil_familia_editar.php?id=" . $id . "&fam_ab=" . $fam_abf . "&nome=" . $row_endereco['nome'] . "&data_nasc=" . $row_endereco['data_nasc'] . "&nome_mae=" . $row_endereco['nome_mae'] . "' class='btn btn-default' title='Editar' data-toggle='modal' data-target='#inserirABFModal'><span class='glyphicon glyphicon-edit text-warning' aria-hidden='true' style='cursor:pointer;' title='Editar'></span></a>";
                                    ?>
                                    <button type="button" class="btn btn-default" title="Editar" data-toggle="modal" data-target="#inserirABFModal">
                                        <span class="glyphicon glyphicon-edit text-warning" aria-hidden="true" style="cursor:pointer;" title="Editar">
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="inserirABFModal" tabindex="-1" role="dialog" aria-labelledby="inserirABFModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title text-center" id="inserirABFModalLabel">Inserir Registro</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="http://localhost/prodacs/auxilio_brasil_familia_editar.php" enctype="multipart/form-data">

                                                <input type="hidden" name="id" id="id" value="<?php echo $row_endereco['id']; ?>">
                                                <input type="hidden" name="fam" id="fam" value="<?php echo $row_endereco['fam']; ?>">
                                                <input type="hidden" name="nome" id="nome" value="<?php echo $row_endereco['nome']; ?>">
                                                <!-- <input name="id" type="hidden" class="form-control" id="id-usuario" value=""> -->

                                                <!--
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nome do Paciente</label>
                                                    <div class="col-sm-10">
                                                        <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome do Paciente" required>
                                                    </div>
                                                </div>
                                                -->

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Data da Coleta</label>
                                                    <div class="col-sm-10">
                                                        <input name="data_coleta" type="date" class="form-control" id="data_coleta" placeholder="Data da Coleta dos Dados" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Peso</label>
                                                    <div class="col-sm-10">
                                                        <input name="peso" type="text" class="form-control" id="peso" placeholder="Peso do Paciente" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Altura</label>
                                                    <div class="col-sm-10">
                                                        <input name="altura" type="text" class="form-control" id="altura" placeholder="Altura do Paciente" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                        <?php
                        } ?>
                    </tbody>
                </table>
                <a href="auxilio_brasil.php" class="btn btn-default" title="Voltar"><span class="glyphicon glyphicon-arrow-left text-info" aria-hidden="true" style="cursor:pointer;" title="Voltar"></span></a>
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