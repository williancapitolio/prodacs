<?php
include_once("conexao.php");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);

echo "$id - $nome - $email - $usuario";

//verificar se tem email no banco igual ao digitado
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_email = "SELECT * FROM `usuarios` WHERE `email` = '{$email}'"; //monto a query
$validar_email = $mysqli->query($valida_email); //executo a query

//verificar se tem usuario no banco igual ao digitado
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_usuario = "SELECT * FROM `usuarios` WHERE `usuario` = '{$usuario}'"; //monto a query
$validar_usuario = $mysqli->query($valida_usuario); //executo a query

if ($validar_email->num_rows > 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Este e-mail já está sendo utilizado.\");
	</script>
";
} elseif ($validar_usuario->num_rows > 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Este usuário já está sendo utilizado.\");
	</script>
";
} else {
	$result_editar = "UPDATE usuarios SET nome = '$nome', email = '$email', usuario = '$usuario' WHERE id = '$id'";
	$resultado_editar = mysqli_query($conn, $result_editar);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
</head>

<body> <?php
		if (mysqli_affected_rows($conn) != 0) {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/usuario.php'>
				<script type=\"text/javascript\">
					alert(\"Usuário editado com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/usuario.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao editar usuário.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>