<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Category extends Model
{
    protected $table = 'project_category';

    // Table does not have timestamps
    public $timestamps = false;

    protected $primaryKey = 'name';

    protected $fillable = [
        'name',
    ];


    public function hasProject()
    {
        return $this->hasMany(Project::class);
    }
}
