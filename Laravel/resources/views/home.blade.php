<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>


    <title>RoadLeaf</title>
</head>

{!! HTML::script('js/leaflet.js')!!}
{!! HTML::script('js/GeoJSONExample/Example1.js')!!}

{!! HTML::style('css/leaflet/leaflet.css') !!}
{!! HTML::style('css/leaflet/leaflet-map.css') !!}

<body>
    <div id="mysidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="{{ url('/home')}}"> Home</a>
        <a href="{{ url('/snuffelen')}}"> Snuffelen</a>
        <a href="{{ url('/about')}}"> About</a>
    </div>
    <span class="navbtn" style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
    <div id="container">
        <img id="background-image" src="{{ asset('img/main.jpg') }}" alt="Bossen van Den Bosch">
        <div id="banner">
            <p>Welkom bij<p>
            <h1>Natuurlijke Brabantse schoonheid</h1>
            <p>Scroll naar beneden om</p>
            <p>Brabant te beleven...</p>
        </div>
    </div>
    <div id="container">
        <div id="mapid">

        </div>

        <script>
            var mymap = L.map('mapid').setView([52.143438, 6.215206], 7.5);

            L.tileLayer('https://api.mapbox.com/styles/v1/sakirma/cjsj37dym6e401gqi2zcu2aph/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'sakirma.cjsj37dym6e401gqi2zcu2aph',
                accessToken: 'pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig' // AccessToken has only read permission.
            }).addTo(mymap);


            // TODO: This has to be done through the database. Retrieve the GeoJSON data and convert it using json_encode().
            L.geoJSON(example).addTo(mymap);

            console.log(example);
        </script>
    </div>
</body>
</html>
