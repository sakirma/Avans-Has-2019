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
                <h1>Bomen in het bos</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere vestibulum pharetra. Phasellus sollicitudin libero in malesuada accumsan. Nullam nulla risus, accumsan sed fringilla quis, feugiat eget lorem. Etiam id porttitor felis, non ultrices diam. Morbi urna turpis, facilisis vitae ligula non, congue condimentum nulla. Sed eros nunc, dignissim efficitur porttitor non, laoreet malesuada lorem. Duis egestas scelerisque velit, eget posuere velit scelerisque at. Morbi porta, massa eu placerat convallis, nulla enim efficitur metus, vel viverra ex nunc sit amet justo. Morbi ac mi quis libero mollis egestas quis ac risus. Ut blandit augue in posuere posuere. In hac habitasse platea dictumst. Phasellus sed malesuada lorem, in euismod ex. Nam molestie turpis et nulla malesuada consectetur. Integer non semper ante.<p>
                <br>
                <p>Donec lacus nulla, vulputate vitae mollis aliquam, molestie quis leo. Aliquam eu pellentesque justo. Aliquam facilisis turpis ligula, vel rutrum ante ultrices in. Pellentesque ac eleifend metus, at condimentum ex. Praesent eleifend pharetra erat et eleifend. Suspendisse diam turpis, ultrices sed iaculis vel, eleifend nec nunc. Donec malesuada imperdiet cursus. Nunc elementum elit at ex vestibulum lacinia. Curabitur molestie pulvinar quam ut ullamcorper. Vestibulum malesuada odio non quam varius fermentum. <p>
                <div class="img-container">
                    <img src="{{ asset('img/three1.jpg') }}">
                    <img src="{{ asset('img/three2.jpg') }}">
                    <img src="{{ asset('img/three3.jpg') }}">
                </div>
            </div>
        </div>
    </body>
</html>