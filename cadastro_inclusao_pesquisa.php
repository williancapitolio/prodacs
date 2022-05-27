<?php
include_once('conexao.php');

//Receber a requisão da pesquisa 
$requestData = $_REQUEST;

//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array(
    0 => 'data',
	1 => 'tipo',
	2 => 'fam',
	3 => 'nome',
	4 => 'data_nasc',
	5 => 'endereco',
    6 => 'status'
);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT * FROM cadastros_inclusoes";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT * FROM cadastros_inclusoes WHERE 1=1";
if (!empty($requestData['search']['value'])) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios .= " AND ( data LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR tipo LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR fam LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR nome LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR data_nasc LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR endereco LIKE '%" . $requestData['search']['value'] . "%' ";
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
	$dado[] = $row_usuarios["tipo"];
	$dado[] = $row_usuarios["fam"];
	$dado[] = $row_usuarios["nome"];
    $dado[] = $row_usuarios["data_nasc"];
    $dado[] = $row_usuarios["endereco"];
	$dado[] = '<a href="cadastro_inclusao_apaga.php?id=' . $row_usuarios['id'] . '" onclick="return confirm(\'Tem certeza que deseja apagar o registro?\')" data-toggle="tooltip" data-placement="top" title="Apagar" class="btn btn-default"><span class="glyphicon glyphicon-trash text-danger  text-info" aria-hidden="true" style="cursor:pointer;" title="Apagar"></span></a>';
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