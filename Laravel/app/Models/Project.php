<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    // Table does not have timestamps
    public $timestamps = false;

    public function project_points()
    {
        return $this->hasMany('App\Models\ProjectPoint');
    }
}