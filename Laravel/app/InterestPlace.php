<?php

namespace App;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class InterestPlace extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'project_id',
        'geo_json',
        'name',
        'information',
    ];

    protected $spatialFields = [
        'geopoint',
    ];
}
