<!-- Fixed navbar -->
<!--<nav class="navbar navbar-inverse navbar-fixed-top">-->
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #42dea4; border-color: #000000;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="color:#333;">ProdACS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <!--class="active"    para deixar marcado -->
                <li><a href="pacientes.php" style="color:#333;">Pacientes</a></li>
                <!-- <li><a href="#" style="color:#333;">Logradouros</a></li> -->
                <!-- <li><a href="mapa.php" style="color:#333;">Mapa de Logradouros</a></li> -->
                <li><a href="user-map.php" style="color:#333;">Mapa de Logradouros</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:#333; background-color: #42dea4;">Produção <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header" style="color:#333;">Diária</li>
                        <li><a href="fechamento_calendario.php" style="color:#333;">Fechamento Calendário</a></li>
                        <li><a href="fechamento_relatorio.php" style="color:#333;">Fechamento Relatório</a></li>
                        <li><a href="situacao_saude.php" style="color:#333;">Situação de Saúde</a></li>
                        <li><a href="insulino.php" style="color:#333;">Insulinodependente</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header" style="color:#333;">Mensal</li>
                        <li><a href="cadastro_inclusao.php" style="color:#333;">Cadastros e Inclusões</a></li>
                        <li><a href="preventivo.php" style="color:#333;">Preventivos</a></li>
                        <li><a href="sisvidas.php" style="color:#333;">SisVidas</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header" style="color:#333;">Semestral</li>
                        <li><a href="auxilio_brasil.php" style="color:#333;">Auxílio Brasil</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"  aria-expanded="false" style="color:#333; background-color: #42dea4;">Relatório Especial <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="natalidade.php" style="color:#333;">Natalidade</a></li>
                        <li><a href="obito.php" style="color:#333;">Óbitos</a></li>
                        <li><a href="marcacao_exame.php" style="color:#333;">Marcação Exame</a></li>
                        <li><a href="resultado_exame.php" style="color:#333;">Resultado Exame</a></li>
                    </ul>
                </li>
                <!-- <li><a href="cadastrar.php" style="color:#333;">Cadastrar Usuario</a></li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:#333; background-color: #42dea4;"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['nome']; ?> <span class="glyphicon glyphicon-menu-down"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="usuario.php" style="color:#333;">Usuários</a></li>
                        <!-- <li><a href="contato.php" style="color:#333;">Contato</a></li> -->
                        <li role="separator" class="divider"></li>
                        <li><a href="sair.php" style="color:#333;"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
<!-- Fixed navbar -->