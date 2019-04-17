<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Route;

class RoutesController extends Controller
{
  public function index()
  {
      $routes = Route::all();   
      return view('routes.routeList', compact('routes'));
  }


}
