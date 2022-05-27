<?php
include_once('conexao.php');

//Receber a requisão da pesquisa 
$requestData = $_REQUEST;

//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array(
	0 => 'fam_ab',
	1 => 'endereco_ab',
    2 => 'chefe_ab',
	3 => 'status_ab'
);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT * FROM auxilio_brasil";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT * FROM auxilio_brasil WHERE 1=1";
if (!empty($requestData['search']['value'])) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios .= " AND ( fam_ab LIKE '%" . $requestData['search']['value'] . "%' ";
    $result_usuarios .= " OR endereco_ab LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR chefe_ab LIKE '%" . $requestData['search']['value'] . "%' ";
	$result_usuarios .= " OR status_ab LIKE '%" . $requestData['search']['value'] . "%' )";
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
	$dado[] = $row_usuarios["fam_ab"];
	$dado[] = $row_usuarios["endereco_ab"];
    $dado[] = $row_usuarios["chefe_ab"];
	//$dado[] = '<a href="auxilio_brasil_familia.php?id=' . $row_usuarios['id'] . '&fam_ab=' . $row_usuarios['fam_ab'] . '" class="btn btn-default" title="Vizualizar Família"><span class="glyphicon glyphicon-home text-info" aria-hidden="true" style="cursor:pointer;" title="Vizualizar Moradores"</span></a>';
	$dado[] = '<a href="auxilio_brasil_familia.php?id=' . $row_usuarios['id'] . '&fam_ab=' . $row_usuarios['fam_ab'] . '" class="btn btn-default" title="Vizualizar Família"><span class="glyphicon glyphicon-home text-info" aria-hidden="true" style="cursor:pointer;" title="Vizualizar Família"</span></a> <a href="auxilio_brasil_apaga.php?id=' . $row_usuarios['id'] . '" onclick="return confirm(\'Tem certeza que deseja apagar o registro?\')" data-toggle="tooltip" data-placement="top" title="Apagar" class="btn btn-default"><span class="glyphicon glyphicon-trash text-danger  text-info" aria-hidden="true" style="cursor:pointer;" title="Apagar"></span></a>';
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