<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaflet</title>
</head>


{!! HTML::script('js/leaflet.js')!!}
{!! HTML::style('css/leaflet.css') !!}
{!! HTML::style('css/example-css/leaflet-map.css') !!}

<body>
    <div id="mapid"> </div>

    <script> 
        var mymap = L.map('mapid').setView([51.505, -0.09], 13);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            // TODO: accessToken has to be put global.
            accessToken: 'pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig' // AccessToken has only read permission.
        }).addTo(mymap);

        // var Thunderforest_Pioneer = L.tileLayer('https://{s}.tile.thunderforest.com/pioneer/{z}/{x}/{y}.png?apikey={apikey}', {
        //     attribution: '&copy; <a href="http://www.thunderforest.com/">Thunderforest</a>, &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        //              Thunderforest.Pioneer API KEY
        //     apikey: '450176119bce4887899777df6ae618bc',
        //     maxZoom: 22
        // }).addTo(mymap);
    </script>
</body>
</html>