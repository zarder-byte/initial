<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceWrite;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ResourceController extends Controller
{
    //资源列表
    public function index(Request $request, Resource $resource){
        $resource = $resource->with('adminuser');
        //首先获取一个stdClass空对象
        $stdclass = new stdClass;
        $stdclass->keyword = $request->input('keyword','');
        $stdclass->adminuser_id = $request->input('adminuser_id','');
        $stdclass->type = $request->input('type',null);
        if($stdclass->keyword){
            $resource = $resource->where('title','like',"%{$stdclass->keyword}%");
        }

        if($stdclass->adminuser_id){
            $resource = $resource->where('adminuser_id',$stdclass->adminuser_id);
        }

        if($stdclass->type){
            $resource = $resource->whereIn('type',$stdclass->type);
        }

        $resources = $resource->orderby('id','desc')->paginate(setting('page_resource'));
        $data = [
            'resources' => $resources,
            'stdclass' =>$stdclass,
        ];
        return view('admin.resource.index',$data);
    }

    //添加，编辑
    public function add(Request $request,Resource $resource){
        $data = [];
        //$type = $request->input('type',null);
        $type = $resource->id ? $resource->type : $request->input('type');
        if(!$type){
            alert('请指定资源类型','danger');
            return redirect()->route('admin.resource');
        }
        $data = [
            'type' => $type,
            'resource' => $resource,
        ];
        return view('admin.resource.add',$data);
    }

    public function save(ResourceWrite $request,Resource $resource){
        $data= $request->validated();
        $data['adminuser_id'] = Auth::guard('admin')->id();
        DB::transaction(function()use($resource,$data){
            //根据资源类型,动态指定关联方法
            switch($data['type']){
                case Resource::VIDEO:
                    $relation = 'video';
                break;
                case Resource::DOC:
                    $relation = 'doc';
                break;
                default:
                alert('403','无效的type类型');
            }
            if($resource->id){
                $resource->update($data);
                $resource->{$relation}->update($data);
            }else{
                $resource->create($data)->{$relation}()->create($data);
            }
        });
        alert('操作成功');
        return redirect()->route('admin.resource');
    }

    public function remove(){

    }

    public function up(){

    }
}
