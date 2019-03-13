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
        //$pointModel = ProjectPointModel::where('id', $id);
        $model = array(
            'name' => 'Test name',
            'information' => 'Test description'
        );

        return view('details')->with($model);
    }
}
