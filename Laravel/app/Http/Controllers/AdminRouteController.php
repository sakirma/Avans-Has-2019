<?php

namespace App\Http\Controllers;

use App\Models\ProjectPoint;
use App\Models\Route;

use App\Models\RouteHasProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;


class AdminRouteController extends Controller
{
    function getRouteData()
    {
        $points = ProjectPoint::all();
        $routes = Route::all();

        $routePoints = RouteHasProjectPoint::all();
        return view('createRoute')->with(['points' => $points, 'routes' => $routes, 'routePoints' => $routePoints]);
    }

    function insertMarkers(Request $request)
    {
        $latlng = $request->latlng;
        $markerNames = $request->name;

        var_dump($latlng);
        for ($i = 0; $i < sizeof($latlng); $i++) {
            $projectpoint = new ProjectPoint;
            $point = new Point($latlng[$i]['lat'], $latlng[$i]['lng']);

            $projectpoint->project_id = 1;
            $projectpoint->location = $point;
            $projectpoint->geo_json = new GeometryCollection([$point]);
            $projectpoint->name = $markerNames[$i];
            $projectpoint->information = 'Test information';

            $projectpoint->save();
        }
    }

    function createRoute(Request $request){

        $ids = $request->ids;
        $latlngs = $request->latlngs;

        $distance = $request->distance;
        $routeName = $request->name;

        if (count($latlngs) < 2) {
            return "Not enough markers to create a route!";
        }
        //TODO check if route has changed (has less markers) compaired to the current route in database
        $route = Route::where('name', $routeName)->first();
        $newRoute = null;

        if($route === null){

            $newRoute = new Route();

            $newRoute->name = $routeName;
            $newRoute->length = round($distance / 1000, 2);
            $newRoute->save();

            $route = Route::where('name', $routeName)->first();
        } else {
            $route->length = round($distance / 1000, 2);
            $route->save();
        }

        var_dump($route);

        for ($i = 0; $i < count($ids); $i++) {

            $routepoints = RouteHasProjectPoint::where('project_point_id', $ids[$i])
                ->where('route_id', $route->id)
                ->first();

            if($routepoints === null) {

                $routepoints = new RouteHasProjectPoint();

                $routepoints->project_point_id = $ids[$i];
                $routepoints->route_id = $route->id;
                $routepoints->save();
            }
        }
        return 'Route added to database!';
    }

    function removeRoute(Request $request)
    {
        if (isset($request["routeID"])) {
            $route = Route::find($request["routeID"]);
            if (!empty($route) && isset($route)) {
                $route->delete();
                return "Successfully deleted route " . $route->name;
            }
        }
        return "Could not remove route because route does not exist";
    }
}
