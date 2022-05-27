var customLabel = {
    restaurant: {
        label: 'R'
    },
    bar: {
        label: 'B'
    }
};

//CRIANDO A VARIÁVEL PRO MAPA
var map;

//CRIANDO CONSTANTE PARA A LATIDADE E LONGITUDE
const centerMap = { lat: -20.614165, lng: -46.046549 }; // PARA APLICAR O BOTÃO

//CLASSE DE CONTROLE PARA O MAPA
class CenterControl {
    constructor(map) {
        this.controlDiv = document.createElement('div');
        this.controlUI = document.createElement('div');
        this.controlText = document.createElement('div');

        this.controlUI.style.backgroundColor = '#fff';
        this.controlUI.style.border = '2px solid #ebebeb';
        this.controlUI.style.borderRadius = '3px';
        this.controlUI.style.padding = '6px';
        this.controlUI.style.cursor = 'pointer';
        this.controlUI.title = 'Centralizar mapa';

        this.controlDiv.appendChild(this.controlUI);

        this.controlText.style.fontSize = '16px';
        this.controlText.style.textAlign = 'center';
        this.controlText.style.lineHeight = '20px';
        this.controlText.style.color = '#333';
        this.controlText.innerHTML = 'Centralizar';

        this.controlUI.appendChild(this.controlText);

        this.controlUI.addEventListener('click', () => {
            map.panTo(centerMap); //IR MAIS SUAVE
            //map.setCenter(centerMap); //IR DE UMA VEZ
        });
    }
}

//INICIANDO A FUNÇÃO
function initMap() {

    //PROPRIEDADES DO MAPA
    const mapProp = {
        center: centerMap,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    //JOGANDO O MAPA NO SITE
    map = new google.maps.Map(document.getElementById('map'), mapProp);

    //INSERINDO O CONTROLE NO MAPA
    const centerControl = new CenterControl(map);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControl.controlDiv);

    //SE TIRAR A VARIÁVEL mapProp FICA ASSIM
    //var map = new google.maps.Map(document.getElementById('map'), {
    //center: centerMap,
    //center: new google.maps.LatLng(-20.614165, -46.046549), // ONDE O MAPA VAI SER ABERTO
    //zoom: 15, // TAMANHO DO ZOOM
    //mapTypeId: google.maps.MapTypeId.HYBRID, // ROADMAP , SATELLITE , HYBRID , TERRAIN - POR PADRÃO É O 'roadmap'
    //disableDefaultUI: true, // DESABILITA OS CAMPOS DO MAPA

    //zoomControl: false, // DESABILITA APENAS O ZOOM
    //streetViewControl: false, // DESABILITA APENAS O STREET VIEW
    //fullscreenControl: false // DESABILITA APENAS O TELA CHEIA
    //mapTypeControl: FALSE // DESABILITA APENAS O TIPO DE MAPA
    //disableDoubleClickZoom: true, // DOIS CLIQUES NÃO DÁ ZOOM
    //});

    var infoWindow = new google.maps.InfoWindow;

    // Change this depending on the name of your PHP or XML file
    downloadUrl('resultado.php', function (data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function (markerElem) {
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var type = markerElem.getAttribute('type');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);
            var icon = customLabel[type] || {};
            var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
            });
            marker.addListener('click', function () {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    });

    //RETORNAR VALORES QUANDO CLICA NO MAPA
    //map.addListener('click', function(e){
        //console.log(e);
    //});

    //INSERIR MARCADOR NO MAPA
    //var markerTeste = new google.maps.Marker({
        //position: { lat: -20.614165, lng: -46.046549 }, //POSIÇÃO DO MARCADOR
        //position: centerMap, //ASSIM TAMBÉM FUNCIONA
        //map: map, //ONDE O MARCADOR VAI SER COLOCADO
        //title: 'Centro do Mapa', //O QUE FICA ESCRITO QUANDO PASSA O MOUSE NO MARCADOR
        //label: 'W', //O QUE FICA ESCRITO NO MARCADOR
        //icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png', //ICONE DO MARCADOR
        //animation: google.maps.Animation.DROP, //BOUNCE - ANIMAÇÃO DO MAPA
        //draggable: true,
    //});

    //REMOVER MARCADOR DO MAPA
    //markerTeste.setMap(null);

    //PEGAR POSIÇÃO ATUAL QUANDO USUÁRIO CLICAR NO MAPA E INSERIR UM MARCADOR
    map.addListener('click', function(e){
        var clickPosition = e.latLng; // PEGANDO A LATITUDE E A LONGITUDE DE ONDE O USUÁRIO CLICOU

        //EM CADA LOCAL QUE CLICAR INSERIR UM MARCADOR
        var markerTesteClique = new google.maps.Marker({
            position: clickPosition, //POSIÇÃO DO MARCADOR
            //position: centerMap, //ASSIM TAMBÉM FUNCIONA
            map: map, //ONDE O MARCADOR VAI SER COLOCADO
            title: 'Centro do Mapa', //O QUE FICA ESCRITO QUANDO PASSA O MOUSE NO MARCADOR
            label: 'W', //O QUE FICA ESCRITO NO MARCADOR
            //icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png', //ICONE DO MARCADOR
            animation: google.maps.Animation.DROP, //BOUNCE - ANIMAÇÃO DO MAPA
            draggable: true,
        });
    });
}



function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function doNothing() { }