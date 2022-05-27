<?php

include_once("conexao.php");

$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$data_nasc = mysqli_real_escape_string($conn, $_POST['data_nasc']);
$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
$comorbidade = mysqli_real_escape_string($conn, $_POST['comorbidade']);


//valida numero da fam
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_usuario = "SELECT `fam`, `nome`, `data_nasc` FROM `pacientes` WHERE `fam` = '{$fam}' AND `nome` = '{$nome}' AND `data_nasc` = '{$data_nasc}'"; //monto a query
$validar_usuario = $mysqli->query($valida_usuario); //executo a query

//valida endereco
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_endereco = "SELECT `endereco` FROM `pacientes` WHERE `fam` = '{$fam}' AND `endereco` = '{$endereco}'"; //monto a query
$validar_endereco = $mysqli->query($valida_endereco); //executo a query

if ($validar_usuario->num_rows == 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Dados não encontrados!\");
	</script>
";
} elseif ($validar_endereco->num_rows == 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Dados não encontrados!\");
	</script>
";
} else {
	$result_natalidade = "INSERT INTO comorbidades (`fam`, `nome`, `data_nasc`, `endereco`, `comorbidade`, `status`) VALUES ('$fam', '$nome', '$data_nasc', '$endereco', '$comorbidade', '1')";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/situacao_saude.php'>
				<script type=\"text/javascript\">
					alert(\"Registro de situação de saúde inserido com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/situacao_saude.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir registro de situação de saúde.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>