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

        <title>Project</title> <!-- Project naam -->
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
                <h1>Project name</h1>
            </div>
            <div id="project-exp">
                <h1>Bomen in het bos</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut enim maximus, eleifend leo cursus, tincidunt est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam rutrum semper est ut semper. Nulla eu finibus nibh. Integer a nisl eros. Nam et pulvinar nulla, id mollis metus. In volutpat blandit lacus quis ultrices. Cras fermentum enim augue, sit amet condimentum libero dapibus id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus fringilla eleifend placerat. Maecenas blandit semper felis sit amet sodales. Integer lacinia, ligula vel interdum congue, nisi elit accumsan augue, eget accumsan ligula massa non purus. Morbi nec mauris mauris.
                    Quisque vel lorem felis. Morbi malesuada justo vitae elementum faucibus. Ut ullamcorper nisl ac rutrum sagittis. Sed id sem risus. Suspendisse lectus dui, aliquam ac urna non, imperdiet gravida justo. Maecenas eget erat et neque sodales imperdiet sed ut est. In mattis at sapien id bibendum. Proin ut nisl consectetur, sollicitudin mauris non, tempor risus. Aliquam eu iaculis purus. Mauris finibus feugiat nibh, vitae ullamcorper odio venenatis eget.
                    Aliquam sit amet tortor gravida, scelerisque urna nec, malesuada ante. Nunc nec semper mi. Fusce suscipit, nunc quis condimentum commodo, augue augue pulvinar tellus, quis blandit ligula neque non elit. Mauris dignissim ut mi eget consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum orci nisl, faucibus eget odio ac, accumsan aliquet quam. Nam rutrum ultrices erat in dictum. Suspendisse mattis nunc a ex hendrerit consequat.
                    Maecenas nisi libero, commodo vitae augue nec, eleifend pellentesque nisi. Ut vulputate mi eu enim sodales, at pulvinar massa blandit. Nullam sit amet arcu eu lectus scelerisque consequat. Cras id pharetra quam. Fusce in sagittis lacus, eget condimentum risus. Proin sit amet pretium diam. Nam vitae eros aliquam, ultrices lacus id, venenatis erat. Aliquam et consectetur lacus. Praesent eu auctor nulla, eu imperdiet magna. Vivamus in placerat lectus. Sed eget sem blandit, tempus tortor id, tincidunt nibh. Donec placerat tellus urna, sed accumsan lorem tempor vel.
                    Praesent a leo justo. Nam tempus nisl eget odio maximus faucibus. Donec auctor, justo in interdum convallis, mi ex volutpat ex, eget pulvinar metus mi sit amet arcu. Sed iaculis rhoncus dui, quis porta felis semper quis. Nam aliquet metus at ipsum pharetra rutrum. Praesent ut rhoncus leo, ac dapibus erat. Nulla tincidunt quam sed elementum lacinia. Maecenas egestas at erat vulputate consectetur. Vestibulum eget sodales ligula. Nunc ut ligula hendrerit, commodo metus non, ultrices lorem. Proin iaculis, erat eu ultrices blandit, massa purus lobortis ipsum, et ornare neque orci nec libero. Nunc a dolor ante. Nullam nec massa molestie, facilisis nibh eu, pharetra neque. Mauris sodales, est eget rhoncus finibus, purus orci pharetra orci, id vestibulum tortor dui vel ante. Curabitur et tellus accumsan, eleifend orci eu, tempor ligula. Praesent eleifend non odio id rhoncus.  
                <p>
            </div>
        </div>
    </body>
</html>