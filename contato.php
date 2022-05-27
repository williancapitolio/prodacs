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

    <!-- PARA O FUNCIONAMENTO DA VALIDAÇÃO DO CONTATO -->
    <script src="js/validar_contato.js"></script>
    <!-- PARA O FUNCIONAMENTO DA VALIDAÇÃO DO CONTATO -->
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

    <body>
        <div class="container theme-showcase" role="main">
            <div class="page-header">
                <h1>Contato</h1>
            </div>
            <form class="form-horizontal" name="formcontato" method="POST" action="salva_mensagem.php">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                        Nome:
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nome" placeholder="" <?php
                                                                                            if (!empty($_SESSION['value_nome'])) {
                                                                                                echo "value='" . $_SESSION['value_nome'] . "'";
                                                                                                unset($_SESSION['value_nome']);
                                                                                            }
                                                                                            ?>>
                        <?php
                        if (!empty($_SESSION['vazio_nome'])) {
                            echo "<p style='color: #f00; '>" . $_SESSION['vazio_nome'] . "</p>";
                            unset($_SESSION['vazio_nome']);
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                        E-mail:
                    </label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="" required <?php
                                                                                                        if (!empty($_SESSION['value_email'])) {
                                                                                                            echo "value='" . $_SESSION['value_email'] . "'";
                                                                                                            unset($_SESSION['value_email']);
                                                                                                        }
                                                                                                        ?>>
                        <?php
                        if (!empty($_SESSION['vazio_email'])) {
                            echo "<p style='color: #f00; '>" . $_SESSION['vazio_email'] . "</p>";
                            unset($_SESSION['vazio_email']);
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                        Assunto:
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="assunto" placeholder="" <?php
                                                                                                if (!empty($_SESSION['value_assunto'])) {
                                                                                                    echo "value='" . $_SESSION['value_assunto'] . "'";
                                                                                                    unset($_SESSION['value_assunto']);
                                                                                                }
                                                                                                ?>>
                        <?php
                        if (!empty($_SESSION['vazio_assunto'])) {
                            echo "<p style='color: #f00; '>" . $_SESSION['vazio_assunto'] . "</p>";
                            unset($_SESSION['vazio_assunto']);
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                        Mensagem:
                    </label>
                    <div class="col-sm-10">
                        <?php
                        if (!empty($_SESSION['value_mensagem'])) { ?>
                            <textarea class="form-control" name="mensagem"><?php echo $_SESSION['value_mensagem']; ?></textarea>
                        <?php
                            unset($_SESSION['value_mensagem']);
                        } else { ?>
                            <textarea class="form-control" name="mensagem"></textarea>
                        <?php }
                        ?>
                        <?php
                        if (!empty($_SESSION['vazio_mensagem'])) {
                            echo "<p style='color: #f00; '>" . $_SESSION['vazio_mensagem'] . "</p>";
                            unset($_SESSION['vazio_mensagem']);
                        }
                        ?>
                    </div>
                </div>

                <input class="btn btn-success" type="submit" value="Enviar" onclick="return validar_form_contato()">
            </form>
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