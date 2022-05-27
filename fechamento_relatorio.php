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
            $('#listar-fechamento_relatorio').DataTable({
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
                "pagingType": "full_numbers", //MOSTRAR O PRIMEIRO E O ÚLTIMO

                // COPIEI A PARTIR DAQUI
                "bDeferRender": true,
                "ajax": {
                    "url": "fechamento_relatorio_pesquisa.php",
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
                        Fechamento Relatório
                    </h1>
                </div>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-success pull-right menu" data-toggle="modal" data-target="#inserirFecRelModal">
                        Inserir Registro
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="inserirFecRelModal" tabindex="-1" role="dialog" aria-labelledby="inserirFecRelModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="inserirFecRelModalLabel">Inserir Fechamento Relatório</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="http://localhost/prodacs/fechamento_relatorio_cadastra.php" enctype="multipart/form-data">
                                        <!-- title="Preencha desta forma: AAAA-MM-DD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"-->

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Data da Visita</label>
                                            <div class="col-sm-10">
                                                <input name="data" type="date" class="form-control" id="data" placeholder="Data da visita" required pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" title="Preencha desta forma: DD/MM/AAAA">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Família</label>
                                            <div class="col-sm-10">
                                                <input name="fam" type="text" class="form-control" id="fam" placeholder="Número da família" required pattern="[0-9]{3}" title="Preencha desta forma: NNN">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Chefe de Família</label>
                                            <div class="col-sm-10">
                                                <input name="chefe" type="text" class="form-control" id="chefe" placeholder="Nome completo do chefe de família" required pattern="[a-zA-Z\s]+" title="Apenas letras e sem caracteres especiais">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Data de Nascimento</label>
                                            <div class="col-sm-10">
                                                <input name="data_nasc" type="date" class="form-control" id="data_nasc" placeholder="Data de nascimento" required pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" title="Preencha desta forma: DD/MM/AAAA">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Motivo da Visita</label>
                                            <div class="col-sm-10">
                                                <textarea name="motivo_vd" type="text" class="form-control" id="motivo_vd" placeholder="Motivo da visita" required></textarea>
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
                <table id="listar-fechamento_relatorio" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th width="9%">Data</th>
                            <th>Família</th>
                            <th>Chefe de Família</th>
                            <th>Data de Nascimento</th>
                            <th>Motivo da Visita</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Data</th>
                            <th>Família</th>
                            <th>Chefe de Família</th>
                            <th>Data de Nascimento</th>
                            <th>Motivo da Visita</th>
                            <th>Ações</th>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- DATATABLE -->
        <a href="fechamento_relatorio_pdf.php" class="btn btn-default"><span class="glyphicon glyphicon-download-alt text-info" aria-hidden="true" style="cursor:pointer;" title="Gerar PDF"></span></a>


    </div>
    <!-- FINALIZAR AQUI -->
</body>

</html>