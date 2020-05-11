<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['key','value','name','comment','sort'];

/**
 * mapWithKeys法遍历集合并将每个值传入给定的回调函数。该回调函数将返回一个包含单个键 / 值对的关联数组：
 * laravel6.x--综合话题--集合
 *
 */
    protected $kvs = null;

    function kv(){
        if($this->kvs === null){
            $this->kvs = $this->orderby('sort','asc')->get()->mapWithKeys(function($item){
                return [$item['key'] => $item['value']];
            });
        }
        return $this->kvs;
    }

}
