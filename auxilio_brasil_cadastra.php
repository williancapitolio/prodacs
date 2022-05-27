<?php

include_once("conexao.php");

$fam_ab = mysqli_real_escape_string($conn, $_POST['fam_ab']);
$query_endereco = "SELECT fam, endereco, nome FROM pacientes where cpf_chefe = cpf AND fam='$fam_ab'";
$result_endereco = mysqli_query($conn, $query_endereco);
$row_endereco = mysqli_fetch_array($result_endereco);

if (empty($row_endereco['fam'])) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/auxilio_brasil.php'>
            <script type=\"text/javascript\">
                alert(\"Nenhum registro encontrado.\");
            </script>
        ";
} else {
    $endereco_ab = $row_endereco['endereco'];
    $chefe_ab = $row_endereco['nome'];

    $result_natalidade = "INSERT INTO auxilio_brasil (`fam_ab`, `endereco_ab`, `chefe_ab`, `status_ab`) VALUES ('$fam_ab', '$endereco_ab', '$chefe_ab', '1')";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/auxilio_brasil.php'>
				<script type=\"text/javascript\">
					alert(\"Registro inserido com sucesso.\");
				</script>
			";
        } else {
            echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/auxilio_brasil.php'>
				<script type=\"text/javascript\">
					alert(\"Erro: Não foi possível inserir registro.\");
				</script>
			";
        } ?>
</body>

</html>
<?php $conn->close(); ?>