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
            $('#listar-pacientes').DataTable({
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
                    "url": "pacientes_pesquisa.php",
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
                        Pacientes
                    </h1>
                </div>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-success pull-right menu" data-toggle="modal" data-target="#inserirPacienteModal">
                        Inserir Registro
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="inserirPacienteModal" tabindex="-1" role="dialog" aria-labelledby="inserirPacienteModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="inserirPacienteModalLabel">Inserir Paciente</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="http://localhost/prodacs/pacientes_cadastra.php" enctype="multipart/form-data">
                                        <!-- title="Preencha desta forma: AAAA-MM-DD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"-->
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Família</label>
                                            <div class="col-sm-10">
                                                <input name="fam" type="text" class="form-control" id="fam" placeholder="Número da família" required pattern="[0-9]{3}" title="Preencha desta forma: NNN">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nome</label>
                                            <div class="col-sm-10">
                                                <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome completo do paciente" required pattern="[a-zA-Z\s]+" title="Apenas letras e sem caracteres especiais">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">CPF</label>
                                            <div class="col-sm-10">
                                                <input name="cpf" type="text" class="form-control" id="cpf" placeholder="CPF do paciente" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Preencha desta forma: XXX.XXX.XXX-XX">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Paciente é o chefe?</label>
                                            <div class="col-sm-10">
                                                <input name="ativo" type="radio" class="form_1" value="S" onclick="if(document.getElementById('cpf_chefe').disabled==false){document.getElementById('cpf_chefe').disabled=true}if(document.getElementById('endereco').disabled==true){document.getElementById('endereco').disabled=false}" /> Sim
                                                <input name="ativo" type="radio" class="form_1" value="N" onclick="if(document.getElementById('cpf_chefe').disabled==true){document.getElementById('cpf_chefe').disabled=false}if(document.getElementById('endereco').disabled==false){document.getElementById('endereco').disabled=true}" /> Não

                                                <input name="cpf_chefe" type="text" class="form-control" id="cpf_chefe" placeholder="CPF do chefe" disabled="disabled" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Preencha desta forma: XXX.XXX.XXX-XX" />


                                                <br><input name="endereco" type="text" class="form-control" id="endereco" placeholder="Endereço do domicílio" disabled="disabled" required  />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Data de Nascimento</label>
                                            <div class="col-sm-10">
                                                <input name="data_nasc" type="date" class="form-control" id="data_nasc" placeholder="Data de nascimento" required pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" title="Preencha desta forma: DD/MM/AAAA">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nome da Mãe</label>
                                            <div class="col-sm-10">
                                                <input name="nome_mae" type="text" class="form-control" id="nome_mae" placeholder="Nome completo da mãe do paciente" required pattern="[a-zA-Z\s]+" title="Apenas letras e sem caracteres especiais">
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
                <table id="listar-pacientes" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Família</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data de Nascimento</th>
                            <th>Nome da Mãe</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Família</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data de Nascimento</th>
                            <th>Nome da Mãe</th>
                            <th>Ações</th>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- DATATABLE -->

        <a href="pacientes_pdf.php" class="btn btn-default"><span class="glyphicon glyphicon-download-alt text-info" aria-hidden="true" style="cursor:pointer;" title="Gerar PDF"></span></a>


    </div>
    <!-- FINALIZAR AQUI -->
</body>

</html>