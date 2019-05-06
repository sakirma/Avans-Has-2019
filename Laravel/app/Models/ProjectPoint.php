<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPoint extends Model
{
    use SpatialTrait;

    protected $table = 'project_point';

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