<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/about.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript" src="{{ asset('js/about.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>

        <title>Details</title>
    </head>
    <body>
        <div id="mysidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="{{ url('/home')}}"> Home</a>
            <a href="{{ url('/snuffelen')}}"> Snuffelen</a>
            <a href="{{ url('/about')}}"> About</a>
        </div>
        <span class="navbtn" style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
        <div class="container">
            <div id="banner">
                <img src="{{ asset('img/about-banner2.jpg') }}" alt="den bosch bossen">
                <h1>Details van {{ $name }}</h1>
            </div>
            <table>
                <tr>
                    <th>Naam:</th>
                    <td>{{ $name }}</td>
                </tr>
                <tr>
                    <th>Omschrijving:</th>
                    <td>{{ $information }}</td>
                </tr>
            </table>
        </div>
    </body>
</html>