<?php

namespace App\Http\Controllers;

use App\Models\ProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;


//TODO (bug) getDatapoints only gets one spatial point ?
class AdminRouteController extends Controller
{
    function getDataPoints(){
        $points = ProjectPoint::all();
        $geoLocations = [];
        foreach ($points as $item) { array_push($geoLocations, $item->location); }
        var_dump($geoLocations);
        return view('createRoute')->with(['points' => $points, 'locations' => $geoLocations]);
    }
    function setDataPoints(Request $request){
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
}
