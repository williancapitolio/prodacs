<?php
include_once('conexao.php');

//Receber a requisão da pesquisa 
$requestData = $_REQUEST;

//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array(
    0 => 'data',
	1 => 'fam',
	2 => 'nome',
	3 => 'data_nasc',
    4 => 'sisvidas',
    5 => 'ar',
    6 => 'nf',
    7 => 'ma',
    8 => 'af',
    9 => 'contato',
    10 => 'status'
);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT * FROM sisvidas";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT * FROM sisvidas WHERE 1=1";
if (!empty($requestData['search']['value'])) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios .= " AND ( data LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR fam LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR nome LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR data_nasc LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR sisvidas LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR ar LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR nf LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR ma LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR af LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR contato LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR status LIKE '%" . $requestData['search']['value'] . "%' )";
}
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
while ($row_usuarios = mysqli_fetch_array($resultado_usuarios)) {
	$dado = array();
	//$dado[] = $row_usuarios["id"]; 
	
	//$dado[] = '<a onclick="return confirm(\' ' . $row_usuarios["nome"] . ' \')" data-toggle="tooltip" data-placement="top" title="Vizualizar" class="info" style="cursor:pointer;">'. $row_usuarios["fam"] .'</a>';
	$dado[] = $row_usuarios["data"];
	$dado[] = $row_usuarios["fam"];
	$dado[] = $row_usuarios["nome"];
    $dado[] = $row_usuarios["data_nasc"];
    $dado[] = $row_usuarios["sisvidas"];
    $dado[] = $row_usuarios["ar"];
    $dado[] = $row_usuarios["nf"];
    $dado[] = $row_usuarios["ma"];
    $dado[] = $row_usuarios["af"];
    $dado[] = $row_usuarios["contato"];
	$dado[] = '<a href="sisvidas_apaga.php?id=' . $row_usuarios['id'] . '" onclick="return confirm(\'Tem certeza que deseja apagar o registro?\')" data-toggle="tooltip" data-placement="top" title="Apagar" class="btn btn-default"><span class="glyphicon glyphicon-trash text-danger  text-info" aria-hidden="true" style="cursor:pointer;" title="Apagar"></span></a>';
	$dados[] = $dado;
}

//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval($requestData['draw']), //para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval($qnt_linhas),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval($totalFiltered), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json