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

    //一对多(反向)
    public function adminuser()
    {
        return $this->belongsTo('App\Models\AdminUser');
    }

    //一对一关联到视频子表
    public function video()
    {
        return $this->hasOne('App\Models\ResourceVideo');
    }

    //一对一关联到文档子表
    public function doc()
    {
        return $this->hasOne('App\Models\ResourceDoc');
    }

    //多对多
    public function chapter(){
        return $this->belongsToMany('App\Models\Chapter', 'chapter_resources')
            ->orderBy('sort','asc')
            ->withPivot('sort')
            ->withTimestamps();
    }


}
