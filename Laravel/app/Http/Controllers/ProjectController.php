<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * @param Request $request
     * featureCollection: JSON format of featureCollection GeoJson
     * pointWKT: Well Known Text for Point
     */
    public function AddProject(Request $request)
    {
        $project = new Project;

        $featureCollection = Geometry::fromJson($request->featureCollection);
        $location = Point::fromWKT($request->pointWKT);

        $project->geo_json = $featureCollection;
        $project->location = $location;
        $project->category = "c_lol";
        $project->name = "gebruiker";
        $project->information = "information_lol";

        $project->save();
    }

    public function create() {
        return view('createProject');
    }

    public function viewProjects() {
        return view('viewProjects');
    }

    /**
     * @param Request $request
     *      pointWKT: Well Known Text for Point
     *      withinDistance:
     *
     * @return Return Point Models
     */
    public function GetProjectWithinDistance(Request $request)
    {
        $usersPosition = Point::fromWKT($request->pointWKT);
        $containsPoint = Project::distance('location', $usersPosition, $request->withinDistance)->get();

        return $containsPoint->toJson();
    }

    /**
     * @param Request $request
     *      id: project_id
     *
     * @return Return View project
     */
    public function index(Request $request){
        $project = Project::find($request['id']);
        return view('project')->with(["project" => $project]);
    }

    public function facetInfo(Request $request){
        $project = Project::find($request['project']);
        return view('project')->with(["project" => $project, "facet_id" => $request['facet_id'], "direction" => $request['direction']]);
    }
}
