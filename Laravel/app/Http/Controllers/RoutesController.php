<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Route;

class RoutesController extends Controller
{
  public function index()
  {
    $routes = Route::all();  
  //  $routes = Route::find(1);

  
return view('routes.routeList', compact('routes'));
  }



}
