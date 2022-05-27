<?php
session_start();
ob_start();
include_once("conexao.php");

$html = '<table border=1 align=center>';
$html .= '<thead>';
$html .= '<tr>';

$html .= '<th>Família</th>';
$html .= '<th>Nome</th>';
$html .= '<th>Data de Nascimento</th>';
$html .= '<th>TD</th>';
$html .= '<th>TI</th>';
$html .= '<th>UI M/T/N</th>';
$html .= '<th>IU</th>';
$html .= '<th>TpD</th>';

$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_usuario = "SELECT * FROM insulinos ORDER BY nome ASC";
$resultado_usuario = mysqli_query($conn, $result_usuario);
while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
    $html .= '<tr><td>' . $row_usuario['fam'] . "</td>";
    $html .= '<td>' . $row_usuario['nome'] . "</td>";
    $html .= '<td>' . $row_usuario['data_nasc'] . "</td>";
    $html .= '<td>' . $row_usuario['tempo_diabetes'] . "</td>";
    $html .= '<td>' . $row_usuario['tempo_insulina'] . "</td>";
    $html .= '<td>' . $row_usuario['ui'] . "</td>";
    $html .= '<td>' . $row_usuario['insulina_utilizada'] . "</td>";
    $html .= '<td>' . $row_usuario['tipo_diabetes'] . "</td>";
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
			<h1 style="text-align: center;">ProdACS - Relatório de Insulinodependentes</h1>
			'. $html .'
		');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "prodacs_insulinodependentes",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
