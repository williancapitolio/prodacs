<?php
session_start();
ob_start();
include_once("conexao.php");

$html = '<table border=1 align=center>';
$html .= '<thead>';
$html .= '<tr>';

$html .= '<th>Data da Coleta</th>';
$html .= '<th>Família</th>';
$html .= '<th>Nome</th>';
$html .= '<th>Data de Nascimento</th>';

$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_usuario = "SELECT * FROM preventivos ORDER BY data ASC";
$resultado_usuario = mysqli_query($conn, $result_usuario);
while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
    $html .= '<tr><td>' . $row_usuario['data'] . "</td>";
    $html .= '<td>' . $row_usuario['fam'] . "</td>";
    $html .= '<td>' . $row_usuario['nome'] . "</td>";
    $html .= '<td>' . $row_usuario['data_nasc'] . "</td>";
}

$html .= '</tbody>';
$html .= '</table';

//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// include autoloader
require_once 'dompdf/autoload.inc.php';

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->loadHtml('
			<h1 style="text-align: center;">ProdACS - Relatório de Preventivos</h1>
			'. $html .'
		');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "prodacs_preventivos",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
