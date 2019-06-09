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

    public function createProject(Request $request){
        if(isset($request->category) && isset($request->name) && isset($request->information)){
            $point = new Project();
            if(isset($request->area)) $point->area = $request->area;
            $point->name = $request->name;
            $point->information= $request->information;
            $point->category = $request->category;
            $point->save();
            return json_encode($point);
        }else{
            return abort(400);
        }
    }

    public function searchForName($name){
        if(isset($name)){
            return json_encode(Project::where("name", "LIKE", "%" . $name . "%")->get());
        }else return abort(400);
    }

    public function create() {
        return view('createProject');
    }

    public function edit ($id) {
        $project = Project::find($id);
        return $project->toJson();
    }

    public function update( Request $request){
        if(isset($request->id) && isset($request->name) && isset($request->information) && isset($request->category)) {
            $project = Project::find($request->id);
            $project->name = $request->name;
            $project->information = $request->information;
            $project->category = $request->category;
            if(isset($request->area)) $project->area = $request->area;
            $project->save();
            return json_encode($project);
        }else{
            return abort(400);
        }
    }

    public function getProjects() {
        return json_encode(Project::all());
    }

    public function getMedia($id){
        if(!isset($id)) return abort(400);
        $model = Project::find($id);
        $images = $model->imageProjects;
        $names = [];
        foreach($images as $image) $names[] = $image->media_name;
        return json_encode($names);
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
    public function getProject(Request $request){
        if(!isset($request->id)) return abort(400);
        return json_encode(Project::find($request->id));
    }

    public function main(){
        return view('beheerder.MainModeratorPage');
    }

    public function facetInfo(Request $request){
        $project = Project::find($request['project']);
        return view('project')->with(["project" => $project, "facet_id" => $request['facet_id'], "direction" => $request['direction']]);
    }

    public function remove(Request $request){
        if(isset($request->id)){
            Project::find($request->id)->delete();
        }else return abort(400);
    }
}
