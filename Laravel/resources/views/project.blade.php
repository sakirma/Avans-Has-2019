<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/project.css') }}">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>

        <title>Project: Vergroening</title> <!-- Project naam -->
    </head>
    <body>
        <div id="mysidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="{{ url('/')}}"> Home</a>
            <a href="{{ url('/about')}}"> About</a>
        </div>
        <span class="navbtn" style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
        <div class="container">
            <div id="banner">
                <img src="{{ asset('img/about-banner2.jpg') }}" alt="den bosch bossen">
                <h1>Project: Vergroening</h1>
            </div>
            <div id="project-exp">
                @if(isset($project) && !empty($project))
                    <h1>{{ $project->name }}</h1>
                    <p>{{ $project->information }}</p>
                    <div>
                        <img onclick="facetBack()" src="{{ asset('img/left_arrow.png') }}">
                    </div>
                    <p>{{ $information }}</p>
                    <div>
                        <img onclick="facetNext()" src="{{ asset('img/right_arrow.png') }}">
                    </div>

                    <div class="img-container">
                        @foreach($project->images() as $image)
                            <img src="{{ route('media.get', ['name' => $image->name]) }}">
                        @endforeach
                    </div>
                @else
                    <p>Could not find any information about this project or project does not exist</p>
                @endif

                <script>

                    function facetBack(){
                        
                    }

                    function facetNext(){

                    }

                </script>
            </div>
        </div>
    </body>
</html>