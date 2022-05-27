<?php
include_once 'header.php';
include_once 'locations_model.php';
?>


<div id="map"></div>

<!------ Include the above in your HEAD tag ---------->
<script>
    //CRIANDO CONSTANTE PARA A LATIDADE E LONGITUDE
    const centerMap = {
        lat: -20.650011,
        lng: -46.047370
    }; // PARA APLICAR O BOTÃO

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

    var map;
    //var marker;
    var marker;
    var infowindow;
    //var red_icon = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
    var red_icon = 'http://maps.google.com/mapfiles/kml/pal3/icon48.png';
    //var purple_icon = 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png';
    var purple_icon = 'http://maps.google.com/mapfiles/kml/pal3/icon57.png';
    var locations = <?php get_all_locations() ?>;

    function initMap() {
        var centerMap = {
            lat: -20.650011,
            lng: -46.047370
        };
        infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById('map'), {
            center: centerMap,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.SATELLITE,
            disableDefaultUI: false, // DESABILITA OS CAMPOS DO MAPA
            disableDoubleClickZoom: true,
        });

        //INSERINDO O CONTROLE NO MAPA
        const centerControl = new CenterControl(map);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControl.controlDiv);


        var i;
        var confirmed = 0;
        for (i = 0; i < locations.length; i++) {

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: locations[i][4] === '1' ? red_icon : purple_icon,
                html: document.getElementById('form')
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    confirmed = locations[i][4] === '1' ? 'checked' : 0;
                    $("#confirmed").prop(confirmed, locations[i][4]);
                    $("#id").val(locations[i][0]);
                    $("#description").val(locations[i][3]);
                    $("#form").show();
                    infowindow.setContent(marker.html);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

    function saveData() {
        var confirmed = document.getElementById('confirmed').checked ? 1 : 0;
        var id = document.getElementById('id').value;
        var url = 'locations_model.php?confirm_location&id=' + id + '&confirmed=' + confirmed;
        downloadUrl(url, function(data, responseCode) {
            if (responseCode === 200 && data.length > 1) {
                infowindow.close();
                window.location.reload(true);
                window.location.replace("http://localhost/prodacs/user-map.php");
            } else {
                infowindow.setContent("<div style='color: purple; font-size: 25px;'>Inserting Errors</div>");
            }
        });
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                callback(request.responseText, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }
</script>

<div style="display: none" id="form">
    <table class="map1">
        <tr>
            <input name="id" type='hidden' id='id' />
            <td><b>Logradouro: </b></td>
            <td><textarea disabled id='description' placeholder='Description'></textarea></td>
        </tr>
        <tr>
            <td><b>Logradouro Confirmado? :</b></td>
            <td><input id='confirmed' type='checkbox' name='confirmed'></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type='button' value='Salvar' onclick='saveData()' />
            </td>
        </tr>
    </table>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8sX0-gmKb-RimlIRtsRvkKbVIXRal3Vo&callback=initMap">
</script>