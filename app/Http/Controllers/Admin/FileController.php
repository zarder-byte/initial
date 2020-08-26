<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //文件管理列表页
    public function index(File $fileModel,AdminUser $adminUser){
        $files = $fileModel->orderby('id','desc')->paginate(8);
        $data = [
            'files' => $files,
        ];
        return view('admin.file.index',$data);
    }

    //文件添加表单页
    public function up(Request $request,File $fileModel){
        $data = [];
        return view('admin.file.up',$data);
    }

    //处理添加的业务逻辑
    public function save(Request $request,File $fileModel){
        //检查文件是否上传以及是否有效
        if( $request->hasFile('filename') && $request->file('filename')->isValid()){
            //获取上传的对象
            $file = $request->file('filename');
            //上传文件的类型是否允许
            if(!in_array($file->extension(),config('project.upload.files'))){
                alert('不被允许的上传类型','danger');
                return redirect()->back();
            }

            //将图像保存到...
            $filepath = $file->store('other','public');
            $fileModel->saveFile('other_upload',$filepath,$file);
            alert('上传成功');
            return redirect()->route('admin.file');
        }else{
            alert('上传失败','danger');
            return back();
        }

    }

}
