<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @param Request $request
     * featureCollection: JSON format of featureCollection GeoJson
     * pointWKT: Well Known Text for Point
     */

    public function addProject (Request $request) {
        $project = new Project();

        $point = new Point($request->lat, $request->long);
        $geometryCollection = new GeometryCollection([$point]);

        $project->name = $request->name;
        $project->information = $request->information;
        $project->category = $request->category;
        $project->location = $point;
        $project->geo_json = $geometryCollection;

        $project->save();
    }
    public function create() {
        return view('createProject');
    }

    public function edit ($id) {
        $project = Project::find($id);
        return $project->toJson();
    }

    public function update( Request $request)
    {
        $project = Project::find($request->id);
        $point = new Point($request->lat, $request->long);
        $geometryCollection = new GeometryCollection([$point]);
        $project->name = $request->name;
        $project->information = $request->information;
        $project->category = $request->category;
        $project->location = $point;
        $project->geo_json = $geometryCollection;
        $project->update($request->all());
    }

    public function viewProjects() {
        return view('viewProjects');
    }
    public function getProjects() {
        $projects = Project::all();
        return $projects->toJson();
    }

    /**
     * @param Request $request
     *      pointWKT: Well Known Text for Point
     *      withinDistance:
     *
     * @return Return Point Models
     */
    public function getProjectWithinDistance(Request $request) {
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

    public function main(){
        return view('beheerder.MainModeratorPage');
    }

    public function createProjectPage(){
        return view('mainCrudPage');
    }

    public function facetInfo(Request $request){
        $project = Project::find($request['project']);
        return view('project')->with(["project" => $project, "facet_id" => $request['facet_id'], "direction" => $request['direction']]);
    }

    public function destroy(Request $request)
    {
        $project = Project::findOrFail($request->id);
        $project->delete();
    }


}
