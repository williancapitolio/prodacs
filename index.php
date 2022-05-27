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
						Início
					</h1>
					<h3>
						<p>Bem-vindo <?php echo $_SESSION['nome']; ?>!</p>
					</h3>
				</div>

				<div>
					<div class="col-sm-12">
						<label class="col-sm-12 col-form-label">
							<p>Escolha um módulo para ser redirecionado</p>
						</label>
						<select name="selecao" class="form-control" id="selecao" required>
							<option value="">Selecione para ser redirecionado</option>
							<option value="http://localhost/prodacs/pacientes.php">Pacientes</option>
							<option value="http://localhost/prodacs/user-map.php">Mapa de Logradouros</option>
							<option value="http://localhost/prodacs/fechamento_calendario.php">Produção → Fechamento Calendário</option>
							<option value="http://localhost/prodacs/fechamento_relatorio.php">Produção → Fechamento Relatório</option>
							<option value="http://localhost/prodacs/situacao_saude.php">Produção → Situação de Saúde</option>
							<option value="http://localhost/prodacs/insulino.php">Produção → Insulinodependente</option>
							<option value="http://localhost/prodacs/cadastro_inclusao.php">Produção → Cadastros e Inclusões</option>
							<option value="http://localhost/prodacs/preventivo.php">Produção → Preventivos</option>
							<option value="http://localhost/prodacs/sisvidas.php">Produção → SisVidas</option>
							<option value="http://localhost/prodacs/auxilio_brasil.php">Produção → Auxílio Brasil</option>
							<option value="http://localhost/prodacs/natalidade.php">Relatório Especial → Natalidade</option>
							<option value="http://localhost/prodacs/obito.php">Relatório Especial → Óbitos</option>
							<option value="http://localhost/prodacs/marcacao_exame.php">Relatório Especial → Macarção de Exame</option>
							<option value="http://localhost/prodacs/resultado_exame.php">Relatório Especial → Resultado de Exame</option>
							<option value="http://localhost/prodacs/usuario.php">Usuários</option>
							<!-- <option value="http://localhost/prodacs/contato.php">Contato</option> -->
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- requer jquery -->
	<script>
		$('#selecao').change(function() {
			window.location = $(this).val();
		});
	</script>

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