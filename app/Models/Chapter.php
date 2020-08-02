<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['course_id','title','desc','sort'];

    /*
    反向一对多
    public function course()
    {
        return $this->belongsTo('App\Models\course');
    }
    */

    public function resource(){
        //多对多关联
        return $this->belongsToMany('App\Models\Resource','chapter_resources')
        ->orderBy('sort','asc')
        ->withPivot('sort')   //从中间表中获取额外的字段
        ->withTimestamps();//
    }
}
