<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RoadLeaf</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">

    {!! HTML::style('css/leaflet/leaflet.css') !!}
    {!! HTML::style('css/leaflet/leaflet-map.css') !!}
    {!! HTML::style('css/leaflet/leaflet-routing-machine.css') !!}

    {!! HTML::script('js/leaflet.js')!!}
    {!! HTML::script('js/leaflet/leaflet-routing-machine.js')!!}



</head>

<body>

<div id="leaflet" style="height: 100vh">
    <script type="text/javascript" src="{{ asset('js/leaflet_core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet_create.js') }}"></script>
</div>



</body>
</html>

