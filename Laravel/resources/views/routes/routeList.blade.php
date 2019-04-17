<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/project.css') }}">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>
</head>

<body>
    <div id="mysidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="{{ url('/home')}}"> Home</a>
        <a href="{{ url('/about')}}"> About</a>
        <a href="{{ url('/project')}}"> Project</a>
    </div>
    <span class="navbtn" style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
    <div class="container">
        <div id="banner">
            <img src="{{ asset('img/about-banner2.jpg') }}" alt="den bosch bossen">
            <h1>Routes</h1>
        </div>

        <!-- fetched css from the project page and combined it with bootstraps --> 
        <div id="project-exp">
            @foreach ($routes as $route)
            <a class="btn btn-success" href="{{url('/home')}}/#map-container" role="button">{{ $route->name }} {{ $route->length }}</a>
            @endforeach
        </div>
    </div>
</body>

</html>