<?php

include_once("conexao.php");

$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$data_nasc = mysqli_real_escape_string($conn, $_POST['data_nasc']);
$nome_mae = mysqli_real_escape_string($conn, $_POST['nome_mae']);


//valida numero da fam
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_usuario = "SELECT `fam`, `nome`, `data_nasc`, `nome_mae` FROM `pacientes` WHERE `fam` = '{$fam}' AND `nome` = '{$nome}' AND `data_nasc` = '{$data_nasc}' AND `nome_mae` = '{$nome_mae}'"; //monto a query
$validar_usuario = $mysqli->query($valida_usuario); //executo a query

if ($validar_usuario->num_rows == 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Dados não encontrados!\");
	</script>
";
} else {
	$result_natalidade = "INSERT INTO natalidades (`fam`, `nome`, `data_nasc`, `nome_mae`, `status`) VALUES ('$fam', '$nome', '$data_nasc', '$nome_mae', '1')";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/natalidade.php'>
				<script type=\"text/javascript\">
					alert(\"Registro de natalidade inserido com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/natalidade.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir registro de natalidade.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>