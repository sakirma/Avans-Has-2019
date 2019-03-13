<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\ProjectPointModel;

class ProjectPointsController extends Controller
{
    public function GetDetails($id)
    {
        // Loading model
       // $model = ProjectPointModel::where('id', $id);
        $model = DB::select('select * from project_points where id=?', [$id]);

        //var_dump($model);
        /*
        $testModel = array(
            'name' => 'Test name',
            'information' => 'Test description'
        );
        */

        // Check if model has been found in DB
        if(!empty($model)){
            return view('details', ['model' => $model]);
        }

        abort(404);
    }
}
