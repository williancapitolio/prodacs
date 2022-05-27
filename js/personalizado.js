document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['interaction', 'dayGrid'],
        //defaultDate: '2019-04-12',
        editable: true,
        eventLimit: true,
        events: 'listar_fechamento.php',
        extraParams: function () {
            return {
                cachebuster: new Date().valueOf()
            };
        },

        //PARA PODER VIZUALIZAR CONTEÚDO 
        eventClick: function (info) {
            $("#apagar_evento").attr("href", "apagar_fechamento.php?id=" + info.event.id); // APAGAR 

            info.jsEvent.preventDefault(); // don't let the browser navigate
            console.log(info.event); //TRAZER OS DADOS PARA O FORMULÁRIO DE EDITAR
            $('#visualizar #id').text(info.event.id);
            $('#visualizar #id').val(info.event.id);
            $('#visualizar #title').text(info.event.title);
            $('#visualizar #title').val(info.event.title);
            $('#visualizar #start').text(info.event.start.toLocaleString());
            $('#visualizar #start').val(info.event.start.toLocaleString());
            $('#visualizar #end').text(info.event.end.toLocaleString());
            $('#visualizar #end').val(info.event.end.toLocaleString());
            $('#visualizar #color').val(info.event.backgroundColor);
            $('#visualizar').modal('show');
        },

        // PARA PODER SELECIONAR DATAS NO CALENDARIO
        selectable: true,
        select: function (info) {
            //alert('Início do evento: ' + info.start.toLocaleString());
            $('#cadastrar #start').val(info.start.toLocaleString());
            $('#cadastrar #end').val(info.end.toLocaleString()); // PARA COLOCAR NO PRÓXIMO DIA
            //$('#cadastrar #end').val(info.start.toLocaleString()); // PARA COLOCAR NO MSM DIA
            $('#cadastrar').modal('show');
        }
    });

    calendar.render();
});

//Mascara para o campo data e hora
function DataHora(evento, objeto) {
    var keypress = (window.event) ? event.keyCode : evento.which;
    campo = eval(objeto);
    if (campo.value == '00/00/0000 00:00:00') {
        campo.value = "";
    }

    caracteres = '0123456789';
    separacao1 = '/';
    separacao2 = ' ';
    separacao3 = ':';
    conjunto1 = 2;
    conjunto2 = 5;
    conjunto3 = 10;
    conjunto4 = 13;
    conjunto5 = 16;
    if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
        if (campo.value.length == conjunto1)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto2)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto3)
            campo.value = campo.value + separacao2;
        else if (campo.value.length == conjunto4)
            campo.value = campo.value + separacao3;
        else if (campo.value.length == conjunto5)
            campo.value = campo.value + separacao3;
    } else {
        event.returnValue = false;
    }
}

//FUNÇÃO PARA CADASTRAR EVENTO NO BANCO DE DADOS ATRAVÉS DO BOTÃO DO FORMULÁIO:addevent
$(document).ready(function () {
    $("#addevent").on("submit", function (event) {
        // PAUSAR A JANELA DO FORMULÁRIO
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "cadastrar_fechamento.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (retorna) {
                if (retorna['sit']) {
                    //$("#msg-cad-cal").html(retorna['msg-cal']);
                    // ATUALIZAR A PÁGINA PARA RECEBER O EVENTO QUE FOI CADASTRADO
                    location.reload();
                } else {
                    $("#msg-cad-cal").html(retorna['msg-cal']);
                }
            }
        })
    });

    //FORMULÁRIO DO EDITAR
    $('.btn-canc-vis').on("click", function () {
        $('.visevent').slideToggle();
        $('.formedit').slideToggle();
    });

    $('.btn-canc-edit').on("click", function () {
        $('.formedit').slideToggle();
        $('.visevent').slideToggle();
    });

    //FUNÇÃO PARA EDITAR EVENTO NO BANCO DE DADOS ATRAVÉS DO BOTÃO DO FORMULÁIO:editevent
    $("#editevent").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "editar_fechamento.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (retorna) {
                if (retorna['sit']) {
                    //$("#msg-cad-cal").html(retorna['msg-cal']);
                    location.reload();
                } else {
                    $("#msg-edit-cal").html(retorna['msg-cal']);
                }
            }
        })
    });
});