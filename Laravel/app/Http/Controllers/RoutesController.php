<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Route;
use App\Models\ProjectPoint;
use App\Models\RouteHasProjectPoint;

class RoutesController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('routes.routeList', compact('routes'));
    }

    public function getProjectPointIDs()
    {
        $ppids = RouteHasProjectPoint::all();
        return $ppids->toJson();
    }

    public function increasePopularity($id){       
        $route = Route::find($id);
        $route->amount_clicks += 1;
        $route->save();
    }

    public function getPopularRoutes(){
        $route = Route::orderBy('amount_clicks','DESC')->limit(5)->get();
        return $route;
    }

    public function getAllRoutes()
    {
        return Route::all();
    }

    public function getProjectPointOfRoute($id)
    {
        $route = RouteHasProjectPoint::select('point_id')->where('route_id', $id)->get();
        $projectPoint = ProjectPoint::findMany($route);
        return json_encode($projectPoint);
    }

}
