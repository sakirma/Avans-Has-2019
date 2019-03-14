<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPointModel extends Model
{
    protected $table = 'project_points';

    // Table does not have timestamps
    public $timestamps = false;
}
