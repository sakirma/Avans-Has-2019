<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class ProjectPoint extends Model
{
    use SpatialTrait;

    protected $table = 'interest_point';
    protected $spatialFields = [
        'location',
        'geo_json'
    ];

    // Table does not have timestamps
    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment', 'point_id');
    }
}