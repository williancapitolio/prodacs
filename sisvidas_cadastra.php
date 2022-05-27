<?php

include_once("conexao.php");

$data = mysqli_real_escape_string($conn, $_POST['data']);
$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$data_nasc = mysqli_real_escape_string($conn, $_POST['data_nasc']);
$sisvidas = mysqli_real_escape_string($conn, $_POST['sisvidas']);
$ar = mysqli_real_escape_string($conn, $_POST['ar']);
$nf = mysqli_real_escape_string($conn, $_POST['nf']);
$ma = mysqli_real_escape_string($conn, $_POST['ma']);
$af = mysqli_real_escape_string($conn, $_POST['af']);
$contato = mysqli_real_escape_string($conn, $_POST['contato']);

//valida numero da fam
$mysqli = new mysqli('localhost', 'root', '', 'prodacs'); //precisar ser assim pra funcionar
$valida_usuario = "SELECT `fam`, `nome`, `data_nasc` FROM `pacientes` WHERE `fam` = '{$fam}' AND `nome` = '{$nome}' AND `data_nasc` = '{$data_nasc}'"; //monto a query
$validar_usuario = $mysqli->query($valida_usuario); //executo a query

if ($validar_usuario->num_rows == 0) { //se retornar algum resultado
	echo "
	<script type=\"text/javascript\">
		alert(\"Dados não encontrados!\");
	</script>
";
} else {
	$result_resultado = "INSERT INTO sisvidas (`data`, `fam`, `nome`, `data_nasc`, `sisvidas`, `ar`, `nf`, `ma`, `af`, `contato`, `status`) VALUES ('$data', '$fam', '$nome', '$data_nasc', '$sisvidas', '$ar', '$nf', '$ma', '$af', '$contato', '1')";
	$resultado_resultado = mysqli_query($conn, $result_resultado);
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/sisvidas.php'>
				<script type=\"text/javascript\">
					alert(\"Registro inserido com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/sisvidas.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir registro.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>