<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['adminuser_id','type','title','desc'];

    const VIDEO = 1;
    const DOC = 2;

    public function getTypeNameAttribute($value)
    {
        return config('project.resource.type')[$this->type];
    }

    public function adminuser()
    {
        return $this->belongsTo('App\Models\AdminUser');
    }

}
