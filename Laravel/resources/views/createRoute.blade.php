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
    {!! HTML::script('js/leaflet/leaflet-routing-machine.js') !!}
</head>

<body>

<div id="leaflet" style="height: 80vh">
    <script type="text/javascript" src="{{ asset('js/leaflet_core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet_create.js') }}"></script>
</div>
<div id="points">
    @foreach($locations as $l)
        <div class="point" style="width: 100px; margin: 20px; display: inline-block;">
            <label>
                Project Name:
                <input type="text" name="project_id" value="{{$l->name}}" readonly>
            </label>
            <label>Location:
                <input type="text" name="latlng" value="{{$l->location}}" readonly>
            </label>
            <label>
                Placed:
                <input type="checkbox" id="button-{{ $id = random_int(0, getrandmax()) }}" name="placed" onclick="onCheckbox( '{{$l->location}}', '{{$id}}' );">
            </label>
        </div>
    @endforeach
</div>

</body>
</html>

