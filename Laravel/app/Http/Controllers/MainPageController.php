<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
    function GetCatagories(){

        $categories = DB::select('SELECT name FROM project_category');
        return view('/home', ['categories' => $categories]);
    }
}
