<?php

namespace App\Http\Controllers;

use App\Models\ProjectPoint;
use App\Models\Route;
use App\Models\RouteHasProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;


//TODO (bug) getDatapoints only gets one spatial point ?
class AdminRouteController extends Controller
{
    function getRouteData(){
        $points = ProjectPoint::all();
        $routes = Route::all();
        $routePoints = RouteHasProjectPoint::all();

        return view('createRoute')->with(['points' => $points, 'routes' => $routes, 'routePoints' => $routePoints]);
    }
    function insertMarkers(Request $request){
        $latlng = $request->latlng;
        $markerNames = $request->name;

       var_dump($latlng);
        for ($i=0; $i<sizeof($latlng); $i++){
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

        if(count($latlngs) < 2) { return "Not enough markers to create a route!"; }
        //TODO check if route already exists
        $route = new Route();
        $route->name = $routeName;
        $route->length = round($distance / 1000, 2);
        $route->save();

        $route = Route::where('name', $routeName)->first();
        var_dump($route);

        for ($i=0; $i<count($ids); $i++){
            $routepoints = new RouteHasProjectPoint();
            $routepoints->project_point_id = $ids[$i];
            $routepoints->route_id = $route->id;
            $routepoints->save();
        }
    }
}
