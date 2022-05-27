//USUÁRIO
$(document).ready(function () {
	$('a[data-confirm]').click(function (ev) {
		var href = $(this).attr('href');
		if (!$('#confirm-delete').length) {
			$('table').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header text-center bg-danger"><b>Apagar</b><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza que deseja apagar o usuário selecionado?</div><div class="modal-footer"><a class="btn btn-danger" id="dataComfirmOK">Apagar</a><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></div></div></div></div>');
		}
		$('#dataComfirmOK').attr('href', href);
		$('#confirm-delete').modal({ show: true });
		return false;

	});
});