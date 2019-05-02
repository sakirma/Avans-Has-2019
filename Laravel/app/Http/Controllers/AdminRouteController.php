<?php

namespace App\Http\Controllers;

use App\Models\ProjectPoint;
use Illuminate\Http\Request;

class AdminRouteController extends Controller
{
    function getDataPoints(){
        $points = ProjectPoint::join('project', 'project_id', '=', 'project.id')->get();
        $geoLocations = [];
        foreach ($points as $item) { array_push($geoLocations, $item->geo_json); }
        return view('createRoute')->with('locations', $points);
    }
}
