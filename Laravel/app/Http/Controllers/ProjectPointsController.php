<?php

namespace App\Http\Controllers;

use App\Models\ProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Validator;
use App\Models\ProjectPoint;

class ProjectPointsController extends Controller
{
    // Return view
    public function create() {
        return view('createProjectPoint');
    }

    public function viewProjectPoints(){
        return view('mainCrudPage');
    }

    // Methods
    public function getProjectPoints() {
        $points = ProjectPoint::all();
        return $points->toJson();
    }

    public function addProjectPoint (Request $request) {
        $point = new ProjectPoint();

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
        $point = ProjectPoint::find($id);
        return $point->toJson();
    }

    public function destroy(Request $request)
    {
        $point = ProjectPoint::findOrFail($request->id);
        $point->delete();
    }

    public function getLocationData(Request $request)
    {
        $allowedLocations=[];
        $pointsInfo = ProjectPoint::select('geo_json')->get();
        /*for ($i=0; $i < $pointInfo.count(); $i){
            if($pointInfo[$i]->distance < $request->distance){
                array_push($allowedLocations, $pointInfo[$i]);
            }
        }*/

        //return json_encode($pointsInfo);
        //return json_encode($allowedLocations);
    }

    public function getDetails($id)
    {
        // Loading model
        $model = ProjectPoint::find($id);

        if(empty($model)) { return view('/project'); }

        $project = $model->project;

        /*
        $testModel = array(
            'name' => 'Test name',
            'information' => 'Test description'
        );
        */

        // Check if model has been found in DB
        if (!empty($model)) {
            return view('details', ['model' => $model, 'project' => $project]);
        }

        return abort(404);
    }

    public function getProjectPointByID($projectPointId){
        $model = ProjectPoint::find($projectPointId);
        if(empty($model)) { echo '$model'; }

        return json_encode($model);
    }
}
