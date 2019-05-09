<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Media;
use App\Models\Facets;

class Project extends Model
{
    use SpatialTrait;

    protected $table = 'project';

    // Table does not have timestamps
    public $timestamps = false;

    protected $fillable = ['location', 'geo_json', 'category', 'name', 'information' ];

    protected $spatialFields = [
        'geo_json',
        'location'
    ];

    public function project_points()
    {
        return $this->hasMany('App\Models\ProjectPoint');
    }

    public function images()
    {
        $images = array();
        $medias = DB::table('project_has_image')->where("project_id", "=", $this->id)->get();
        foreach($medias as $media){
            $images[] = Media::find($media->media_name);
        }
        return $images;
    }

    public function facets()
    {
        return $this->hasMany('App\Models\Facet');
    }

    public function sortedFacets()
    {
        $facets = $this->facets;
        $sorted = [];
        foreach($facets as $facet){
            if(count($sorted) > 0){
                for($i = 0; $i < count($sorted); $i++){
                    if($facet->route_id < $sorted[$i]->route_id){
                        array_splice($sorted, $i, 0, array($facet));
                        break;
                    }else if($i >= (count($sorted)-1)){
                        $sorted[] = $facet;
                        break;
                    }
                }
            }else{
                $sorted[] = $facet;
            }
        }
        return $sorted;
    }
}