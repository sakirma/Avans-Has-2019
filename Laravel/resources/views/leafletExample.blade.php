<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaflet</title>
</head>


{!! HTML::script('js/leaflet.js')!!}
{!! HTML::style('css/leaflet/leaflet.css') !!}
{!! HTML::style('css/leaflet/leaflet-map.css') !!}

    <body>
        <div id="mapid"> </div>

        <script> 
            var mymap = L.map('mapid').setView([52.143438, 6.215206], 7.5);

            L.tileLayer('https://api.mapbox.com/styles/v1/sakirma/cjsj37dym6e401gqi2zcu2aph/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'sakirma.cjsj37dym6e401gqi2zcu2aph',
                accessToken: 'pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig' // AccessToken has only read permission.
            }).addTo(mymap);

            L.popup()
                .setLatLng([52.143438, 6.215206])
                .setContent('<p>Hello world!<br />This is a nice popup.</p>')
                .openOn(mymap);
        </script>
    </body>
</html>