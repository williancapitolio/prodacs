<?php
session_start();
include_once('conexao.php');
if (empty($_POST['nome'])) {
    $_SESSION['vazio_nome'] = "Campo nome é obrigatório";
    $url = 'http://localhost/prodacs/contato.php';
    echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
		";
} else {
    $_SESSION['value_nome'] = $_POST['nome'];
}

if (empty($_POST['email'])) {
    $_SESSION['vazio_email'] = "Campo e-mail é obrigatório";
    $url = 'http://localhost/prodacs/contato.php';
    echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
		";
} else {
    $_SESSION['value_email'] = $_POST['email'];
}

if (empty($_POST['assunto'])) {
    $_SESSION['vazio_assunto'] = "Campo assunto é obrigatório";
    $url = 'http://localhost/prodacs/contato.php';
    echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
		";
} else {
    $_SESSION['value_assunto'] = $_POST['assunto'];
}

if (empty($_POST['mensagem'])) {
    $_SESSION['vazio_mensagem'] = "Campo mensagem é obrigatório";
    $url = 'http://localhost/prodacs/contato.php';
    echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
		";
} else {
    $_SESSION['value_mensagem'] = $_POST['mensagem'];
}

$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$assunto = mysqli_real_escape_string($conn, $_POST['assunto']);
$mensagem = mysqli_real_escape_string($conn, $_POST['mensagem']);


$result_msg_contato = "INSERT INTO mensagens_contatos(nome, email, assunto, mensagem, created) VALUES ('$nome', '$email', '$assunto', '$mensagem', NOW())";
//$resultado_msg_contato = mysqli_query($conn, $result_msg_contato);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body> <?php
        if ($nome != "" || $email != "" || $assunto != "" || $mensagem != "") {
            $resultado_msg_contato = mysqli_query($conn, $result_msg_contato);

            /*
            //SENDGRIP
            require 'lib/vendor/autoload.php';

            $from = new SendGrid\Email(null, "willian.2195678@discente.uemg.br");
            $subject = "Mensagem de contato";
            $to = new SendGrid\Email(null, $email);
            $content = new SendGrid\Content("text/html", "Olá Willian, <br><br>Nova mensagem de contato<br><br>Nome: $nome<br>Email: $email <br>Assunto: $assunto <br>Mensagem: $mensagem");
            $mail = new SendGrid\Mail($from, $subject, $to, $content);

            //Necessário inserir a chave
            $apiKey = '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';
            $sg = new \SendGrid($apiKey);

            $response = $sg->client->mail()->send()->post($mail);
            //SENDGRIP
            */

            echo "
            
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/contato.php'>
				<script type=\"text/javascript\">
					alert(\"Mensagem enviada com sucesso!\");
				</script>
			";
        } else {
            echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/contato.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao enviar mensagem.\");
				</script>
			";
        } ?>
</body>

</html>
<?php $conn->close(); ?>