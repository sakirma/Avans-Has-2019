<?php

namespace App\Http\Controllers;

use App\Models\Media;

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
    
    //Needs a name for the file that the user wants to save + a folder (projects/projectpoints) (you can find these folders in public/img/) + the request needs an image as well
    //this function does not add project_has_image/point_has_image entries in the tables...
    public function saveMedia(Request $request){
        $image = $request->file('image');
        if(isset($request['name']) && isset($request['folder']) && $image){
            $path = $request['folder'] . "/" . $request["name"] . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path, File::get($image));
            $media = new Media;
            $media->fill(["name" => $request['name'],
                        "path" => $path]);
            $media->save();
            return view('mediaExample', ["media" => $media]);
        }else{
            return redirect()->back()->withErrors("You did not fill in the required data...");
        }
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
