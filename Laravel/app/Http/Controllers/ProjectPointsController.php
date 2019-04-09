<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator;
use App\Models\ProjectPoint;

class ProjectPointsController extends Controller
{
    public function getDetails($id)
    {
        // Loading model
        $model = ProjectPoint::find($id);
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

        abort(404);
    }
}
