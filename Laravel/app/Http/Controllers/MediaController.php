<?php

namespace App\Http\Controllers;

use App\Models\Media;

use App\Models\PointHasImage;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use App\Models\ProjectHasImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    //shows an view with just a form in it to create a post request
    public function index(){
        $media = new Media;
        return view('mediaExample');
    }

    private function is_valid_name($file) {
        return preg_match('/^([-\.\w]+)$/', $file) > 0;
    }
    
    //Needs a name for the file that the user wants to save + a folder (projects/points) (you can find these folders in public/img/) + the request needs an image as well + the id of the project/point which the image is connected to
    public function saveMedia(Request $request){
        $image = $request->file('image');
        if(isset($request['name']) && isset($request['folder']) && $image && isset($request["id"])){
            $request["name"] = htmlspecialchars($request["name"], ENT_QUOTES, 'UTF-8');
            if(!$this->is_valid_name($request["name"])){
                return redirect()->back()->withErrors("Bestandsnaam is niet toegestaan, de naam mag geen speciale tekens bevatten");
            }
            
            $path = $request['folder'] . "/" . $request["name"] . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path, File::get($image));
            $media = new Media;
            $media->fill(["name" => $request['name'],
                        "path" => $path]);
            $media->save();

            if($request["folder"] == "projects"){
                $phi = new ProjectHasImage();
                $phi->project_id = $request["id"];
                $phi->media_name = $media->name;
                $phi->save();
                return json_encode($phi);
            }else if($request["folder"] == "points"){
                $phi = new PointHasImage();
                $phi->point_id = $request["id"];
                $phi->media_name = $media->name;
                $phi->save();
                return json_encode($phi);
            }
            //return view('mediaExample', ["media" => $media]);
        }else{
            Log::debug("Could not save media");
            return abort(400);
        }
    }

    //media (name from media which needs to be deleted)
    //folder in which it has to search (projects/points)
    public function removeMedia(Request $request){
        if(isset($request->medianame) && isset($request->folder) && ($request->folder == "projects" || $request->folder == "points")){
            Media::find($request->medianame)->delete();
        }else return abort(400);
    }

    //returns media based on a given name
    public function getMedia($name){
        $media = Media::find($name);
        $file = null;
        if(!empty($media)){
            $file = Storage::disk('public')->get($media->path);
        }
        return new Response($file, 200);
    }

}
