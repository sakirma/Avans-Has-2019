<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Routes;

class RoutesController extends Controller
{
  public function index()
  {
      $routes = Routes::all();   
      return view('routes.routeList', compact('routes'));
  }


}
