<?php
session_start();

include_once './conexao_calendario.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converter a data e hora do início do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

//Converter a data e hora do fim do formato brasileiro para o formato do Banco de Dados
$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$query_event = "INSERT INTO events (title, color, start, end) VALUES (:title, :color, :start, :end)";

$insert_event = $conn->prepare($query_event);
$insert_event->bindParam(':title', $dados['title']);
$insert_event->bindParam(':color', $dados['color']);
$insert_event->bindParam(':start', $data_start_conv);
$insert_event->bindParam(':end', $data_end_conv);

if ($insert_event->execute()) {
    $retorna = ['sit' => true, 'msg-cal' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
    // APRESENTAR A MENSAGEM NA PARTE DE FORA DO FORMULÁRIO DO CADASTRO
    $_SESSION['msg-cal'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
} else {
    $retorna = ['sit' => false, 'msg-cal' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi cadastrado com sucesso!</div>'];
}


header('Content-Type: application/json');
echo json_encode($retorna);


// echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/usuario.php'><script type=\"text/javascript\">alert(\"Nenhum usuário encontrado.\");</script>";
