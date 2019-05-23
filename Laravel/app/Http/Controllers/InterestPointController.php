<?php

namespace App\Http\Controllers;

use App\Models\InterestPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;

class InterestPointController extends Controller
{
    // Return view
    public function create() {
        return view('createInterestPoint');
    }

    public function viewInterestPoints(){
        return view('MainCrudPage');
    }

    // Methods
    public function getInterestPoints() {
        $points = InterestPoint::all();

        return $points->toJson();
    }

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

    public function edit ($id) {
        $point = InterestPoint::find($id);
        return $point->toJson();
    }

    public function destroy(Request $request)
    {
        $point = InterestPoint::findOrFail($request->id);
        $point->delete();
    }
}
