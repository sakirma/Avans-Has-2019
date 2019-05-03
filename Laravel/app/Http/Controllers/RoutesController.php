<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\route_has_project_point;

class RoutesController extends Controller
{
  public function index()
  {
    $routes = Route::all();    
    return view('routes.routeList', compact('routes'));
  }

  public function getProjectPointIDs()
  {
    $ppids = route_has_project_point::all();
    return $ppids;
  }
}
