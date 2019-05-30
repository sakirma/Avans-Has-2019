<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class ProjectPoint extends Model
{
    use SpatialTrait;

    protected $table = 'interest_point';

    protected $fillable = ['project_id', 'name', 'information', 'category' ];

    protected $spatialFields = [
        'location',
        'area'
    ];

    // Table does not have timestamps
    public $timestamps = false;
}