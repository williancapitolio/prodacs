<?php

include_once("conexao.php");

$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$data_nasc = mysqli_real_escape_string($conn, $_POST['data_nasc']);
$data_obito = mysqli_real_escape_string($conn, $_POST['data_obito']);
$motivo = mysqli_real_escape_string($conn, $_POST['motivo']);

if ($data_nasc > $data_obito) {
	echo "
	<script type=\"text/javascript\">
		alert(\"Data de Óbito anterior a data de nascimento!\");
	</script>
";
} else {
	$result_natalidade = "INSERT INTO obitos (`fam`, `nome`, `data_nasc`, `data_obito`, `motivo`, `status`) VALUES ('$fam', '$nome', '$data_nasc', '$data_obito', '$motivo', '1')";
	$resultado_natalidade = mysqli_query($conn, $result_natalidade);

	//$result_edit = "UPDATE pacientes (`nome`) VALUES ('$nome - ÓBITO') WHERE `fam` = '{$fam}' AND `nome` = '{$nome}' AND `data_nasc` = '{$data_nasc}'";
	//$resultado_edit = mysqli_query($conn, $result_edit);
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/obito.php'>
				<script type=\"text/javascript\">
					alert(\"Registro de óbito inserido com sucesso.\");
				</script>
			";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/obito.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir registro de óbito.\");
				</script>
			";
		} ?>
</body>

</html>
<?php $conn->close(); ?>