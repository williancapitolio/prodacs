<?php
session_start();
ob_start();

if (empty($_SESSION['id'])) {
  $_SESSION['msgcad'] = "<div class='alert alert-danger'>Faça o login!</div>";
  header("Location: login.php");
}
?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
  <title>ProdACS</title>

  <!-- CSS PARA O ESTILO DO MAPA -->
  <link rel="stylesheet" type="text/css" href="css/map.css">
  <!-- CSS PARA O ESTILO DO MAPA -->

  <!-- API DO MAPA -->
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <!-- API DO MAPA -->

  <!-- PARA O FUNCIONAMENTO DA NAVBAR -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  <link href="css/theme.css" rel="stylesheet">
  <script src="js/ie-emulation-modes-warning.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- PARA O FUNCIONAMENTO DA NAVBAR -->
</head>

<body role="document">
  <!-- Fixed navbar -->
  <?php
  include_once 'fixed_navbar.php';
  ?>
  <!-- Fixed navbar -->

  <!-- CHAMANDO O MAPA -->
  <div id="map"></div>
  <!-- CHAMANDO O MAPA -->
  <div>
    <a href="cadastrar_familia_mapa.php" class="btn btn-link">Cadastrar Posição</a>
    <!-- <a href="index.php" class="btn btn-link">Voltar</a> -->
  </div>

  <!-- MAPA -->

  <!-- JS DO MAPA -->
  <script src="js/map.js"></script>
  <!-- JS DO MAPA -->

  <!-- ONDE FICA A CHAVE DA API PARA O FUNCIONAMENTO DO MAPA -->
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8sX0-gmKb-RimlIRtsRvkKbVIXRal3Vo&callback=initMap"></script>
  <!-- ONDE FICA A CHAVE DA API PARA O FUNCIONAMENTO DO MAPA -->

  <!-- MAPA -->


  <!-- PARA O FUNCIONAMENTO DA NAVBAR -->
  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="js/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/docs.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="js/ie10-viewport-bug-workaround.js"></script>
  <!-- PARA O FUNCIONAMENTO DA NAVBAR -->

</body>

</html>