<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facet extends Model
{
    protected $table = "facets";
    protected $primaryKey = ["project_id", "route_id"];
    protected $fillable = ["project_id", "route_id", "information"];
    public $timestamps = false;
    public $incrementing = false;
}
