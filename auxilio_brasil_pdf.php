<?php
session_start();
ob_start();
include_once("conexao.php");

$html = '<table border=1 align=center>';
$html .= '<thead>';
$html .= '<tr>';

$html .= '<th>Família</th>';
$html .= '<th>Endereço</th>';
$html .= '<th>Chefe</th>';

$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_usuario = "SELECT * FROM auxilio_brasil ORDER BY fam_ab ASC";
$resultado_usuario = mysqli_query($conn, $result_usuario);
while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
    $html .= '<tr><td>' . $row_usuario['fam_ab'] . "</td>";
    $html .= '<td>' . $row_usuario['endereco_ab'] . "</td>";
    $html .= '<td>' . $row_usuario['chefe_ab'] . "</td>";
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
			<h1 style="text-align: center;">ProdACS - Relatório do Auxílio Brasil</h1>
			'. $html .'
		');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "prodacs_auxilio_brasil",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
