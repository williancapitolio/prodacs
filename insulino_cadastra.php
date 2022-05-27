<?php

include_once("conexao.php");

$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$data_nasc = mysqli_real_escape_string($conn, $_POST['data_nasc']);
$tempo_diabetes = mysqli_real_escape_string($conn, $_POST['tempo_diabetes']);
$tempo_insulina = mysqli_real_escape_string($conn, $_POST['tempo_insulina']);
$ui = mysqli_real_escape_string($conn, $_POST['ui']);
$insulina_utilizada = mysqli_real_escape_string($conn, $_POST['insulina_utilizada']);
$tipo_diabetes = mysqli_real_escape_string($conn, $_POST['tipo_diabetes']);


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
	$result_resultado = "INSERT INTO insulinos (`fam`, `nome`, `data_nasc`, `tempo_diabetes`, `tempo_insulina`, `ui`, `insulina_utilizada`, `tipo_diabetes`, `status`) VALUES ('$fam', '$nome', '$data_nasc', '$tempo_diabetes', '$tempo_insulina', '$ui', '$insulina_utilizada', '$tipo_diabetes', '1')";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/insulino.php'>
				<script type=\"text/javascript\">
					alert(\"Registro inserido com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/insulino.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir registro.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>