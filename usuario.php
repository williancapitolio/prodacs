<?php
session_start();
ob_start();

//if(!empty($_SESSION['id'])){
//    echo "Olá ".$_SESSION['nome'].", seja bem vindo! ";
//    echo "<a href='sair.php'>Sair</a><br>";
//}else{
//    $_SESSION['msg'] = "<div class='alert alert-danger'>Faça o login!</div>";
//    header("Location: login.php");
//}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Willian Pereira da Silva">
	<link rel="icon" href="images/favicon.ico">

	<title>ProdACS</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
	<script src="js/ie-emulation-modes-warning.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- FUNÇÃO EM JAVASCRIPT PARA VALIDAR CADASTRO DE NOVO USUARIO -->
	<script type="text/javascript">
		/* script para validar o cadastro de novo usuário */
		function validar() {
			/* atribuir para variável = nome do formulário.nome do campo. quer o valor do campo */
			var nome = formuser.nome.value;
			var email = formuser.email.value;
			var usuario = formuser.usuario.value;
			var senha = formuser.senha.value;

			if (nome == "") {
				alert('Preencha o campo nome.');
				formuser.nome.focus();
				return false;
			}

			if (email == "") {
				alert('Preencha o campo e-mail.');
				formuser.email.focus();
				return false;
			}

			if (email.indexOf('@') == -1) {
				alert('Preencha o campo e-mail corretamente.');
				formuser.email.focus();
				return false;
			}

			if (usuario == "") {
				alert('Preencha o campo usuário.');
				formuser.usuario.focus();
				return false;
			}

			if (usuario.indexOf('Agente ') == -1) {
				alert('Preencha o campo usuário corretamente, iniciando com "Agente".');
				formuser.usuario.focus();
				return false;
			}

			if (senha == "") {
				alert('Preencha o campo senha.');
				formuser.senha.focus();
				return false;
			}

			if (senha.length <= 5) {
				alert('Preencha o campo senha com mínimo 6 caracteres');
				formuser.senha.focus();
				return false;
			}
		}
	</script>
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

	<?php
	if (!empty($_SESSION['id'])) {
		//echo "Olá ".$_SESSION['nome'].", seja bem vindo! ";
		//echo "<a href='sair.php'>Sair</a><br>";
	} else {
		$_SESSION['msg'] = "<div class='alert alert-danger'>Faça o login!</div>";
		header("Location: login.php");
	}
	?>

	<div class="container theme-showcase" role="main">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<h1>
						Usuários
					</h1>
				</div>
				<div class="col-sm-6 col-md-6" style='text-align:right'>
					<h1>
						<form class="form-inline" method="GET" action="pesquisar_usuario.php">
							<h1>
								<div class="form-group">
									<input type="text" name="pesquisar" class="form-control" id="exampleInputName2" placeholder="Digitar...">
								</div>
								<button type="submit" class="btn btn-primary">Pesquisar</button>

						</form>
					</h1>
				</div>
			</div>
		</div>

		<div class="row">
			<!-- <span class="glyphicon glyphicon-cog btn-lg text-success" aria-hidden="true"></span> -->
			<!-- <button type="button" class="btn btn-sm btn-success">Cadastrar</button> -->
			<div class="btn-group pull-right">
				<span class="glyphicon glyphicon-cog btn-lg text-success" style="cursor:pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
				<ul class="dropdown-menu">
					<!-- <li><a href="cadastrar.php">Cadastrar</a></li> -->
					<li><a><span style="cursor:pointer;" data-toggle="modal" data-target="#myModalcad">Cadastrar</span></a></li>
					<li><a href="pdf_relatorio_usuario.php">Gerar PDF</a></li>
					<li><a href="pdf_relatorio_usuario_baixar.php">Baixar PDF</a></li>
				</ul>
			</div>
		</div>

		<!-- Inicio Modal Cadastrar -->
		<div class="modal fade" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel"><b>Cadastrar</b></h4>
					</div>
					<div class="modal-body">
						<form name="formuser" method="POST" action="http://localhost/prodacs/cadastrar_usuario.php" enctype="multipart/form-data">
							<div class="form-group">
								<label for="recipient-name" class="control-label">Nome:</label>
								<input name="nome" type="text" class="form-control" required> <!-- required -->
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">E-mail:</label>
								<input name="email" type="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">Usuário:</label>
								<input name="usuario" type="text" class="form-control" required pattern="^Agente [A-Za-z0-9_]{1,15}$" title="O usuário inicia com 'Agente '">
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">Senha:</label>
								<input name="senha" type="password" class="form-control" pattern=".{6,}" title="A senha deverá ter no mínimo 6 caracteres.">
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success" onclick="return validar()">Cadastrar</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Fim Modal Cadastrar -->

		<!-- FUNCIONA SÓ SE TIVER NO ADMINISTRATIVO E NO LISTAR_USUARIO ??? -->
		<!-- Início Modal para Editar -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<!-- <h4 class="modal-title text-center" id="exampleModalLabel"><b>Editar</b></h4>
							DEIXANDO DO JEITO ABAIXO FICA APARECENDO O EDITAR
							-->
						<h4 class="text-center"><b>Editar</b></h4>
					</div>
					<div class="modal-body">
						<!-- <form method="POST" action="acao_editar_usuario.php"> -->
						<form name="formuseredit" method="POST" action="http://localhost/prodacs/acao_editar_usuario.php" enctype="multipart/form-data">
							<div class="form-group">
								<label for="recipient-name" class="control-label">Nome:</label>
								<input name="nome" type="text" class="form-control" id="recipient-nome" required>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">E-mail:</label>
								<input name="email" type="email" class="form-control" id="recipient-email" required>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">Usuário:</label>
								<input name="usuario" type="text" class="form-control" id="recipient-usuario" required pattern="^Agente [A-Za-z0-9_]{1,15}$" title="O usuário inicia com 'Agente '">
							</div>
							<input name="id" type="hidden" class="form-control" id="id-usuario" value="">
							<div class="modal-footer">
								<button type="submit" class="btn btn-warning">Editar</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$('#exampleModal').on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var recipient = button.data('whatever') // Extract info from data-* attributes
				var recipientnome = button.data('whatevernome')
				var recipientemail = button.data('whateveremail')
				var recipientusuario = button.data('whateverusuario')
				// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				var modal = $(this)
				//modal.find('.modal-layout').text('New message to ' + recipient)
				modal.find('#id-usuario').val(recipient)
				modal.find('#recipient-nome').val(recipientnome)
				modal.find('#recipient-email').val(recipientemail)
				modal.find('#recipient-usuario').val(recipientusuario)
			})
		</script>
		<!-- Fim Modal para Editar -->

		<div class="row">
			<div class="col-md-12">
				<span id="conteudo"></span>
				<script>
					var qnt_result_pg = 5; //quantidade de registro por página
					var pagina = 1; //página inicial

					$(document).ready(function() {
						listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
					});

					function listar_usuario(pagina, qnt_result_pg) {
						var dados = {
							pagina: pagina,
							qnt_result_pg: qnt_result_pg
						}
						$.post('listar_usuario.php', dados, function(retorna) {
							//Subtitui o valor no seletor id="conteudo"
							$("#conteudo").html(retorna);
						});
					}
				</script>
			</div>
		</div>
	</div>

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

	<!-- JS PARA APRESENTAR JANELA MODAL PARA APAGAR REGISTROS -->
	<script src="js/modal-apagar.js"></script>
</body>

</html>