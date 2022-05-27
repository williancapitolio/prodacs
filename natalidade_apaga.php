<?php
session_start();
include_once('conexao.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    $result_apagar = "DELETE FROM natalidades WHERE id='$id'";
    $resultado_apagar = mysqli_query($conn, $result_apagar);
    if (mysqli_affected_rows($conn)) {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/natalidade.php'>
            <script type=\"text/javascript\">
                alert(\"Registro apagado com sucesso!\");
            </script>
        ";
    } else {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/natalidade.php'>
            <script type=\"text/javascript\">
                alert(\"Erro ao apagar registro.\");
            </script>
        ";
    }
} else {
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/natalidade.php'>
        <script type=\"text/javascript\">
            alert(\"Necessário selecionar um registro.\");
        </script>
    ";
}