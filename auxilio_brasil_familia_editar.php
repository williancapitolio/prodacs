<?php

include_once("conexao.php");

$id = mysqli_real_escape_string($conn, $_POST['id']);

if (empty($id)) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/auxilio_brasil.php'>
            <script type=\"text/javascript\">
                alert(\"Nenhum registro encontrado.\");
            </script>
        ";
}

$fam = mysqli_real_escape_string($conn, $_POST['fam']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);

$data_coleta = mysqli_real_escape_string($conn, $_POST['data_coleta']);
$peso = mysqli_real_escape_string($conn, $_POST['peso']);
$altura = mysqli_real_escape_string($conn, $_POST['altura']);

$result_editar = "UPDATE pacientes SET data_coleta = '$data_coleta', peso = '$peso', altura = '$altura' WHERE fam = '$fam' AND nome = '$nome'";
$resultado_editar = mysqli_query($conn, $result_editar);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
</head>

<body> <?php
        if (mysqli_affected_rows($conn) != 0) {
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/auxilio_brasil.php'>
				<script type=\"text/javascript\">
					alert(\"Registro inserido com sucesso.\");
				</script>
			";
        } else {
            echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/auxilio_brasil.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao inserir registro.\");
				</script>
			";
        } ?>
</body>

</html>
<?php $conn->close(); ?>