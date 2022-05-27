<?php
session_start();
ob_start();
include_once("conexao.php");

$html = '<table border=1 align=center>';
$html .= '<thead>';
$html .= '<tr>';

$html .= '<th>Matrícula</th>';
$html .= '<th>Nome</th>';
$html .= '<th>E-mail</th>';
$html .= '<th>Usuário</th>';

$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_usuario = "SELECT * FROM usuarios";
$resultado_usuario = mysqli_query($conn, $result_usuario);
while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
    $html .= '<tr><td>' . $row_usuario['id'] . "</td>";
    $html .= '<td>' . $row_usuario['nome'] . "</td>";
    $html .= '<td>' . $row_usuario['email'] . "</td>";
    $html .= '<td>' . $row_usuario['usuario'] . "</td>";
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
			<h1 style="text-align: center;">ProdACS - Relatório de Usuários</h1>
			'. $html .'
		');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "prodacs_relatorio_usuarios.pdf",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
