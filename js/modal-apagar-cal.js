//CALENDÁRIO
$(document).ready(function () {
	$('a[data-confirm]').click(function (ev) {
		var href = $(this).attr('href');
		if (!$('#confirm-delete-cal').length) {
			$('body').append('<div class="modal fade" id="confirm-delete-cal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header text-center bg-danger"><h4><b>Apagar</b></h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza que deseja apagar o evento selecionado?</div><div class="modal-footer"><a class="btn btn-danger" id="dataComfirmOK-cal">Apagar</a><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></div></div></div></div>');
		}
		$('#dataComfirmOK-cal').attr('href', href);
		$('#confirm-delete-cal').modal({ show: true });
		return false;

	});
});