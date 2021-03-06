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

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            $('#listar-resultado_exame').DataTable({
                //dom: "Bfrtip",
                "processing": true,
                "serverSide": true,
                //"ajax": {
                //  "url": "natalidade_pesquisa.php",
                //"type": "POST" // LISTAR DADOS BD
                //},
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json" // COLOCAR EM PT BR
                },
                "pagingType": "full_numbers", //MOSTRAR O PRIMEIRO E O ??LTIMO

                // COPIEI A PARTIR DAQUI
                "bDeferRender": true,
                "ajax": {
                    "url": "resultado_exame_pesquisa.php",
                    "type": "POST"
                },

            });
        });
    </script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <!-- PARA O FUNCIONAMENTO DA DATATABLE -->
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
        //echo "Ol?? ".$_SESSION['nome'].", seja bem vindo! ";
        //echo "<a href='sair.php'>Sair</a><br>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Fa??a o login!</div>";
        header("Location: login.php");
    }
    ?>
    <!-- VERIFICAR SE USUARIO CLICOU POR LINK SEM ESTAR LOGADO -->

    <!-- COME??AR DAQUI -->

    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h1>
                        Resultado de Exames
                    </h1>
                </div>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-success pull-right menu" data-toggle="modal" data-target="#inserirResultadoModal">
                        Inserir Registro
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="inserirResultadoModal" tabindex="-1" role="dialog" aria-labelledby="inserirResultadoModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="inserirResultadoModalLabel">Inserir Resultado de Exame</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="http://localhost/prodacs/resultado_exame_cadastra.php" enctype="multipart/form-data">
                                        <!-- title="Preencha desta forma: AAAA-MM-DD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"-->
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Fam??lia</label>
                                            <div class="col-sm-10">
                                                <input name="fam" type="text" class="form-control" id="fam" placeholder="N??mero da fam??lia" required pattern="[0-9]{3}" title="Preencha desta forma: NNN">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nome</label>
                                            <div class="col-sm-10">
                                                <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome completo" required pattern="[a-zA-Z\s]+" title="Apenas letras e sem caracteres especiais">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Data de Nascimento</label>
                                            <div class="col-sm-10">
                                                <input name="data_nasc" type="date" class="form-control" id="data_nasc" placeholder="Data de nascimento" required pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" title="Preencha desta forma: DD/MM/AAAA">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tipo de Exame</label>
                                            <div class="col-sm-10">
                                                <input name="exame_tipo" type="text" class="form-control" id="exame_tipo" placeholder="Tipo de Exame" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Resultado do Exame</label>
                                            <div class="col-sm-10">
                                                <input name="exame_resultado" type="text" class="form-control" id="exame_resultado" placeholder="Resultado do Exame" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Observa????o</label>
                                            <div class="col-sm-10">
                                                <input name="observacao" type="text" class="form-control" id="observacao" placeholder="Observa????o Sobre o Exame" required>
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
                </div>
            </div>
        </div>

        <!-- DATATABLE -->
        <div class="row">
            <div class="col-md-12">
                <table id="listar-resultado_exame" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fam??lia</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Tipo de Exame</th>
                            <th>Resultado do Exame</th>
                            <th>Observa????o</th>
                            <th>A????es</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Fam??lia</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Tipo de Exame</th>
                            <th>Resultado do Exame</th>
                            <th>Observa????o</th>
                            <th>A????es</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- DATATABLE -->
        <a href="resultado_exame_pdf.php" class="btn btn-default"><span class="glyphicon glyphicon-download-alt text-info" aria-hidden="true" style="cursor:pointer;" title="Gerar PDF"></span></a>


    </div>
    <!-- FINALIZAR AQUI -->
</body>

</html>