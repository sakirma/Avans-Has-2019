<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator;
use App\Models\ProjectPoint;

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
            return view('details', ['model' => $model, 'project' => $project]);
        }



        return abort(404);
    }
}
