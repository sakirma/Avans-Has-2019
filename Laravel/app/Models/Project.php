<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use SpatialTrait;

    protected $table = 'project';

    // Table does not have timestamps
    public $timestamps = false;

    protected $spatialFields = [
        'geo_json',
        'location'
    ];

    public function project_points()
    {
        return $this->hasMany('App\Models\ProjectPoint');
    }
}