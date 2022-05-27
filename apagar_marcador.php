<?php
$con = mysqli_connect("localhost", 'root', '', 'prodacs');
if (!$con) {
    die('Not connected : ' . mysqli_connect_error());
}
//$id = $_GET['id'];
// update location with confirm if admin confirm.
$query = "DELETE FROM locations WHERE id='" . $_GET['id'] . "'";
$result = mysqli_query($con, $query);
if ($result ) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/user-map.php'>
            <script type=\"text/javascript\">
                alert(\"Marcador apagado com sucesso!\");
            </script>
        ";
} else {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/user-map.php'>
            <script type=\"text/javascript\">
                alert(\"Erro ao apagar marcador.\");
            </script>
        ";
};
