<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;

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
}
