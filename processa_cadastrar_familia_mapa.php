<?php
session_start();
ob_start();
include_once("conexao.php");

//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Salvar os dados no bd
$result_markers = "INSERT INTO markers(name, address, lat, lng, type) VALUES (
    '" . $dados['name'] . "', 
    '" . $dados['address'] . "', 
    '" . $dados['lat'] . "', 
    '" . $dados['lng'] . "', 
    '" . $dados['type'] . "'
    )";
$resultado_markers = mysqli_query($conn, $result_markers);

if (mysqli_insert_id($conn)) {
    $_SESSION['msg'] = "<div class='alert alert-success'>Posição cadastrada no mapa com sucesso!</div>";
    header("Location: cadastrar_familia_mapa.php");
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadasatrar posição no mapa!</div>";
    header("Location: cadastrar_familia_mapa.php.php");
}
