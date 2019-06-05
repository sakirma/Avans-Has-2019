<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\ProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class ProjectPointsController extends Controller
{
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
                $arr[] = ["id" => $point["id"], "info" => $point["area"]];
            }else{
                $arr[] = ["id" => $point["id"], "info" => $point["location"]];
            }
        }
        return json_encode($arr);
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
            $point->area = $request->area;
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
