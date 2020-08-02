<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceWrite;
use App\Models\File;
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

    public function remove(Resource $resource){
        //资源如果被使用情况下，则禁止删除(待添加功能)
        if($resource->chapter()->count()>0){
            alert('删除失败，请先删除关联的章节','danger');
            return back();
        }
        $resource->delete();
        alert('操作成功');
        return back();
    }

    public function up(Request $request,File $fileModel){
        $result = [
            'success' => false,
            'msg' => '尚未实现上传功能',
            'file_path' => '',
            //'ext' => $request->file('image_file')->extension(),
        ];

        //检查是否上传了文件
        if(!$request->hasFile('image_file')){
            $result['msg'] = '未选择文件';
            return response()->json($result);
        }

        //获取上传文件对象
        $file = $request->file('image_file');

        //检查文件有效性
        if(!$file->isValid()){
            $result['msg'] = $file->getErrorMessage();
            return response()->json($result);
        }

        //检查文件类型
        if( !in_array( $file->extension(), config('project.upload.image') ) ){
            $result['msg'] = '不被允许的文件类型';
            return response()->json($result);
        }

        $file_path = $file->store('doc','public');

        //插入数据库
        $fileModel = $fileModel->saveFile('doc_editor',$file_path,$file);

        //通之编辑器上传成功
        $result['success'] = true;
        $result['file_path'] = $fileModel->FileLink;

        return $result;
    }
}
