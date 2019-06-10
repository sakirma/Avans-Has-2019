<?php

namespace App\Http\Controllers;

use App\Models\ProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use console;


use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use Validator;

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

        $location = new Point($request->markerLat, $request->markerLong);

        $point->project_id = $request->project_id;
        $point->location = $location;
        $point->area = $request->area;
        $point->name = $request->name;
        $point->information = $request->information;
        $point->category = $request->category;

        $point->save();
        return json_encode($point);
    }

    public function edit ($id) {
        $point = ProjectPoint::find($id);
        return $point->toJson();
    }

    public function update( Request $request)
    {
        $projectPoint = ProjectPoint::find($request->id);

        $location = new Point($request->lat, $request->long);

        $projectPoint->project_id = $request->project_id;
        $projectPoint->location = $location;
        $projectPoint->area = null;
        $projectPoint->name = $request->name;
        $projectPoint->information = $request->information;
        $projectPoint->category = $request->category;
        $projectPoint->save();
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
            return view('details', ['model' => $model]);
        }

        return abort(404);
    }

    public function getAllPointsFullInfo(){
        return json_encode(ProjectPoint::all());
    }

    public function getAllPoints(){
        $points = ProjectPoint::all();
        $arr = [];
        foreach($points as $point){
            if($point["area"] != null){
                $arr[] = ["id" => $point["id"], "info" => $point["area"], "category" => $point->category];
            }else{
                $arr[] = ["id" => $point["id"], "info" => $point["location"], "category" => $point->category];
            }
        }
        return json_encode($arr);
    }

    public function searchForName($name){
        if(isset($name)){
            return json_encode(ProjectPoint::where("name", "LIKE", "%" . $name . "%")->get());
        }else return abort(400);
    }

    public function getProjectPointByID($projectPointId){
        $model = ProjectPoint::find($projectPointId);
        $model["comments"] = $model->comments;
        return json_encode($model);
    }

    public function getMedia($id){
        if(!isset($id)) return abort(400);
        $model = ProjectPoint::find($id);
        $images = $model->imagePoints;
        $names = [];
        foreach($images as $image) $names[] = $image->media_name;
        return json_encode($names);
    }

    public function createPoint(Request $request){
        if(isset($request->lat) && isset($request->long) && isset($request->name) && isset($request->information)){
            $point = new ProjectPoint();
            $point->project_id = $request->project_id;
            $point->location = new Point($request->lat, $request->long);
            if(isset($request->area)) $point->area = $request->area;
            $point->name = $request->name;
            $point->information= $request->information;
            $point->category = $request->category;
            $point->save();
            return json_encode($point);
        }else{
            return abort(400);
        }
    }

    public function updatePoint(Request $request){
        if(isset($request->id) && isset($request->lat) && isset($request->long) && isset($request->name) && isset($request->information)) {
            $point = ProjectPoint::find($request->id);
            $point->project_id = $request->project_id;
            $point->location = new Point($request->lat, $request->long);
            if(isset($request->area)) $point->area = $request->area;
            $point->name = $request->name;
            $point->information = $request->information;
            $point->category = $request->category;
            $point->save();
            return json_encode($point);
        }else{
            return abort(400);
        }
    }

    public function removePoint(Request $request){
        if(isset($request->id)){
            ProjectPoint::find($request->id)->delete();
        }else return abort(400);
    }
}
