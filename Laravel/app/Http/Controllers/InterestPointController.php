<?php

namespace App\Http\Controllers;

use App\Models\InterestPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;

class InterestPointController extends Controller
{
    public function addInterestPoint (Request $request) {
        $point = new InterestPoint();

        $location = new Point($request->lat, $request->long);
        $geometryCollection = new GeometryCollection([$location]);

        $point->name = $request->name;
        $point->information = $request->information;
        $point->category = $request->category;
        $point->location = $location;
        $point->area = $geometryCollection;

        $point->save();
    }

    public function create() {
        return view('createInterestPoint');
    }
}
