<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    //资源列表
    public function index(Request $request, Resource $resource){
        $resources = $resource->orderby('id','desc')->paginate(setting('page_resource'));
        $data = [
            'resources' => $resources,
        ];
        return view('admin.resource.index',$data);
    }

    //添加，编辑
    public function add(Request $request,Resource $resource){
        $data = [];
        $type = $request->input('type',null);
        if(!$type){
            alert('请指定资源类型','danger');
            return redirect()->route('admin.resource');
        }
        $data = [
            'type' => $type,
        ];
        return view('admin.resource.add',$data);
    }

    public function save(){

    }

    public function remove(){

    }

    public function up(){

    }
}
