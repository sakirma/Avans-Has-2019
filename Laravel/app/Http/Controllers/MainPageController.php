<?php

namespace App\Http\Controllers;

use App\Models\Category;

class MainPageController extends Controller
{
    function GetCatagories(){
        $categories = Category::all();
        return $categories->toJson();
    }

    function index()
    {
        return view('mainPage');
    }
}
