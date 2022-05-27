<?php

include_once("conexao.php");

$data = mysqli_real_escape_string($conn, $_POST['data']);
$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$chefe = mysqli_real_escape_string($conn, $_POST['chefe']);
$data_nasc = mysqli_real_escape_string($conn, $_POST['data_nasc']);
$motivo_vd = mysqli_real_escape_string($conn, $_POST['motivo_vd']);


//valida numero da fam
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_usuario = "SELECT `fam`, `nome`, `data_nasc` FROM `pacientes` WHERE `fam` = '{$fam}' AND `nome` = '{$chefe}' AND `data_nasc` = '{$data_nasc}'"; //monto a query
$validar_usuario = $mysqli->query($valida_usuario); //executo a query

if ($validar_usuario->num_rows == 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Dados não encontrados!\");
	</script>
";
} else {
	$result_natalidade = "INSERT INTO relatorios (`data`, `fam`, `chefe`, `data_nasc`, `motivo_vd`, `status`) VALUES ('$data', '$fam', '$chefe', '$data_nasc', '$motivo_vd', '1')";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/fechamento_relatorio.php'>
				<script type=\"text/javascript\">
					alert(\"Registro de fechamento produção inserido com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/fechamento_relatorio.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir registro de fechamento produção.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>