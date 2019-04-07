<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h1>Routes</h1>
        @foreach ($routes as $route)
        <li>{{ $route->name }} {{ $route->length }} </li>

        @endforeach
    </body>
</html>