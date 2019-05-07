<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Route;
use App\Models\ProjectPoint;
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
    return $ppids->toJson();
  }

  public function getAllRoutes(){
    return Route::all();  
  }

  public function getProjectPointOfRoute($id) {
    $route = route_has_project_point::select('project_point_id')->where('route_id', $id)->get();

    $projectPoint = ProjectPoint::findMany($route);

    return json_encode($projectPoint);
  }

}
