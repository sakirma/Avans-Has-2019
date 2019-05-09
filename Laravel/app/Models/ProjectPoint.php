<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class ProjectPoint extends Model
{
    use SpatialTrait;

    protected $table = 'project_point';
    protected $spatialFields = [
        'location',
        'geo_json'
    ];

    protected $spatialFields = [
        'geo_json',
        'location'
    ];

    // Table does not have timestamps
    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'projects_id');
    }
}