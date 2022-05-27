<?php
session_start();
ob_start();
include_once("conexao.php");

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);

//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados
$result_usuario = "SELECT * FROM usuarios ORDER BY id ASC LIMIT $inicio, $qnt_result_pg";
$resultado_usuario = mysqli_query($conn, $result_usuario);

//Verificar se encontrou resultado na tabela "usuarios"
if (($resultado_usuario) and ($resultado_usuario->num_rows != 0)) {
?>
    <table class="table">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            ?>
                <tr>
                    <th><?php echo $row_usuario['id']; ?></th>
                    <td><?php echo $row_usuario['nome']; ?></td>
                    <td><?php echo $row_usuario['email']; ?></td>
                    <td><?php echo $row_usuario['usuario']; ?></td>
                    <td>
                        <span class="glyphicon glyphicon glyphicon-eye-open text-info" aria-hidden="true" style="cursor:pointer;" title='Visualizar' data-toggle="modal" data-target="#myModal<?php echo $row_usuario['id']; ?>"></span>
                        <span class="glyphicon glyphicon-edit text-warning text-info" aria-hidden="true" style="cursor:pointer;" title='Editar' data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $row_usuario['id']; ?>" data-whatevernome="<?php echo $row_usuario['nome']; ?>" data-whateveremail="<?php echo $row_usuario['email']; ?>" data-whateverusuario="<?php echo $row_usuario['usuario']; ?>"></span>
                        <?php echo "<a href='acao_apagar_usuario.php?id=" . $row_usuario['id'] . "' data-confirm='Tem certeza que deseja apagar o usuário selecionado?'><span class='glyphicon glyphicon-trash text-danger text-info' aria-hidden='true' style='cursor:pointer;' title='Apagar'></span></a>" ?>
                    </td>
                </tr>

                <!-- Início Modal para Visualizar -->
                <div class="modal fade" id="myModal<?php echo $row_usuario['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center" id="myModalLabel"><b>Visualizar</b></h4>
                            </div>
                            <div class="modal-body">
                                <p><b>Matrícula:</b> <?php echo $row_usuario['id']; ?></p>
                                <p><b>Nome:</b> <?php echo $row_usuario['nome']; ?></p>
                                <p><b>E-mail:</b> <?php echo $row_usuario['email']; ?></p>
                                <p><b>Usuário:</b> <?php echo $row_usuario['usuario']; ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fim Modal para Visualizar -->

                <!-- FUNCIONA SÓ SE TIVER NO ADMINISTRATIVO E NO LISTAR_USUARIO ??? -->
                <!-- Início Modal para Editar -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <!-- <h4 class="modal-title text-center" id="exampleModalLabel"><b>Editar</b></h4>
							DEIXANDO DO JEITO ABAIXO FICA APARECENDO O EDITAR
							-->
                                <h4 class="text-center"><b>Editar</b></h4>
                            </div>
                            <div class="modal-body">
                                <!-- <form method="POST" action="acao_editar_usuario.php"> -->
                                <form name="formuseredit" method="POST" action="http://localhost/prodacs/acao_editar_usuario.php" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Nome:</label>
                                        <input name="nome" type="text" class="form-control" id="recipient-nome" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">E-mail:</label>
                                        <input name="email" type="email" class="form-control" id="recipient-email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Usuário:</label>
                                        <input name="usuario" type="text" class="form-control" id="recipient-usuario" required pattern="^Agente [A-Za-z0-9_]{1,15}$" title="O usuário inicia com 'Agente '">
                                    </div>
                                    <input name="id" type="hidden" class="form-control" id="id-usuario" value="">
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $('#exampleModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('whatever') // Extract info from data-* attributes
                        var recipientnome = button.data('whatevernome')
                        var recipientemail = button.data('whateveremail')
                        var recipientusuario = button.data('whateverusuario')
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this)
                        //modal.find('.modal-layout').text('New message to ' + recipient)
                        modal.find('#id-usuario').val(recipient)
                        modal.find('#recipient-nome').val(recipientnome)
                        modal.find('#recipient-email').val(recipientemail)
                        modal.find('#recipient-usuario').val(recipientusuario)
                    })
                </script>
                <!-- Fim Modal para Editar -->

            <?php
            } ?>
        </tbody>
        <!-- JS PARA APRESENTAR JANELA MODAL PARA APAGAR REGISTROS -->
        <script src="js/modal-apagar.js"></script>
    </table>
<?php
    //Paginação - Somar a quantidade de usuários
    $result_pg = "SELECT COUNT(id) AS num_result FROM usuarios";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);

    //Quantidade de pagina
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    //Limitar os link antes depois
    $max_links = 2;

    echo '<nav class="text-center">';
    echo '<ul class="pagination">';
    echo '<li class="page-item">';
    //echo "<span class='page-link'><a href='#' onclick='listar_usuario(1, $qnt_result_pg)'>Primeira</a></span>";
    echo "<span class='page-link'><a href='#' onclick='listar_usuario(1, $qnt_result_pg)'><span class='glyphicon glyphicon glyphicon-menu-left' aria-hidden='true'></span></a></span>";
    echo '</li>';
    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_usuario($pag_ant, $qnt_result_pg)'>$pag_ant </a></li>";
        }
    }
    echo '<li class="page-item active">';
    echo '<span class="page-link">';
    echo " $pagina ";
    echo '</span>';
    echo '</li>';
    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_usuario($pag_dep, $qnt_result_pg)'>$pag_dep</a></li>";
        }
    }
    echo '<li class="page-item">';
    echo "<span class='page-link'><a href='#' onclick='listar_usuario($quantidade_pg, $qnt_result_pg)'><span class='glyphicon glyphicon glyphicon glyphicon-menu-right' aria-hidden='true'></span></a></span>";
    echo '</li>';
    echo '</ul';
    echo '</nav';
} else {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/prodacs/usuario.php'>
            <script type=\"text/javascript\">
                alert(\"Nenhum usuário encontrado.\");
            </script>
        ";
}
