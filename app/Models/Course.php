<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['adminuser_id','title','desc','sort','image'];

    //图片获取器
    function getImageLinkAttribute(){
        if(empty($this->image)){
            return asset('static/images/course-default.jpg');
        }
        return asset("storage/".$this->image);
    }

}
