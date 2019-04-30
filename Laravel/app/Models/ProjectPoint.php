<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPoint extends Model
{
    protected $table = 'project_point';

    // Table does not have timestamps
    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'projects_id');
    }
}