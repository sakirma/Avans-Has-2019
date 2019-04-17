<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectCrudController extends Controller
{
    public function index()
    {
       
        return view('addProject');
    }
  
}
