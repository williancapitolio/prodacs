<?php

include_once("conexao.php");

$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
$cpf_chefe = mysqli_real_escape_string($conn, $_POST['cpf_chefe']);
if ($cpf_chefe == "") {
	$cpf_chefe = $cpf;
}
$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
$data_nasc = mysqli_real_escape_string($conn, $_POST['data_nasc']);
$nome_mae = mysqli_real_escape_string($conn, $_POST['nome_mae']);

//valida numero da fam no mapa
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_usuario = "SELECT `description` FROM `locations` WHERE `description` = '{$fam}'"; //monto a query
$validar_usuario = $mysqli->query($valida_usuario); //executo a query

//validar cpf
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_cpf = "SELECT cpf FROM `pacientes` WHERE `cpf` = '{$cpf}'"; //monto a query
$validar_cpf = $mysqli->query($valida_cpf); //executo a query

if ($validar_usuario->num_rows == 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Necessário cadastrar a família no Mapa de Logradouros!\");
	</script>
";
} elseif ($validar_cpf->num_rows > 0) {
	echo "
	<script type=\"text/javascript\">
		alert(\"CPF já cadastrado!\");
	</script>
";
} else {
	$result_natalidade = "INSERT INTO pacientes (`fam`, `nome`, `cpf`, `cpf_chefe`, `endereco`, `data_nasc`, `nome_mae`, `status`) VALUES ('$fam', '$nome', '$cpf', '$cpf_chefe', '$endereco', '$data_nasc', '$nome_mae', '1')";
	$resultado_natalidade = mysqli_query($conn, $result_natalidade);
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/pacientes.php'>
				<script type=\"text/javascript\">
					alert(\"Paciente inserido com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/pacientes.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir paciente.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>