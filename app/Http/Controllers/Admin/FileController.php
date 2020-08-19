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
        $data = [];
        return view('admin.file.index',$data);
    }

    //文件添加表单页
    public function up(Request $request,File $fileModel){
        $data = [];
        return view('admin.file.up',$data);
    }

    //处理添加的业务逻辑
    public function save(Request $request,File $fileModel){

    }

}
