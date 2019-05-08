<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteHasProjectPoint extends Model
{
    protected $table = 'route_has_project_point';
    protected $primaryKey = ['project_point_id', 'route_id'];

    public $incrementing = false;
    public $timestamps = false;
}
