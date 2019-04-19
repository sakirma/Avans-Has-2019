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

                    <?php
                        if(!isset($facet_id)) $facet_id = 0;
                        
                        if(isset($_POST["back"])){
                            $facet_id = $_POST["facet_id"] + 1;
                            if($facet_id > count($project->facets))
                                $facet_id = 0;
                        }else if(isset($_POST["next"])){
                            $facet_id = $_POST["facet_id"] - 1;
                            if($facet_id < 0)
                                $facet_id = count($project->facets) - 1;
                        }
                    ?>

                    <form id="facet-form" method="POST">
                        <input type="hidden" name="facet_id" value="{{ $facet_id }}">
                        <div>
                            <input onclick="event.preventDefault(); document.getElementById('facet-form').submit();" type="image" name="back" src="{{ asset('img/left_arrow.png') }}">
                        </div>
                        <p>{{ $project->sortedFacets()[$facet_id] }}</p>
                        <div>
                            <input onclick="event.preventDefault(); document.getElementById('facet-form').submit();" type="image" name="next" src="{{ asset('img/right_arrow.png') }}">
                        </div>
                    </form>

                    <div class="img-container">
                        @foreach($project->images() as $image)
                            <img src="{{ route('media.get', ['name' => $image->name]) }}">
                        @endforeach
                    </div>
                @else
                    <p>Could not find any information about this project or project does not exist</p>
                @endif
            </div>
        </div>
    </body>
</html>