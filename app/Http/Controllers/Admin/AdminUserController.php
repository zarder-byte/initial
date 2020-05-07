<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //列表
    public function index(AdminUser $adminuser){
        $adminusers = $adminuser->orderby('id','desc')->get();
        $data = [
            'adminusers' => $adminusers,
        ];
        return view('admin.adminuser.index',$data);
    }

    //添加编辑表单页
    public function add(AdminUser $adminuser){
        $data = [
            'adminuser' => $adminuser,
        ];
        return view('admin.adminuser.add',$data);
    }

    //添加编辑业务逻辑
    public function save(AdminUserRequest $request,AdminUser $adminuser){
        //超级管理员只能由本人操作
        $this->authorizeForUser(Auth::guard('admin')->user(),'modify',$adminuser);
        $data = $request->validated();

        //添加和编辑的适配
        if($adminuser->id){
            //编辑模式-状态无需操作,对密码处理
            if($data['password']){
                $data['password'] = Hash::make($data['password']);
            }else{
                unset($data['password']);
            }
            $adminuser->update($data);
        }else{
            //添加模式--状态和密码的操作
            $data['password'] = Hash::make($data['password']);
            $data['state'] = $adminuser::NORMAL;
            $adminuser->create($data);
        }

        alert('管理员操作成功');
        return redirect()->route('admin.adminuser');
    }

    //软删除
    public function remove(AdminUser $adminuser){
        //超级管理员禁止删除
        $this->authorizeForUser(Auth::guard('admin')->user(),'remove',$adminuser);
        //软删除
        $adminuser->delete();
        //跳转
        alert('删除成功');
        return back();
    }

    //切换状态
    public function state(AdminUser $adminuser){
        //超级管理员禁止切换状态
        $this->authorizeForUser(Auth::guard('admin')->user(),'remove',$adminuser);
        //获取反向状态
        $new_state = ($adminuser->state == AdminUser::NORMAL) ? AdminUser::BAN : AdminUser::NORMAL;
        //将新状态赋值给数据模型
        $adminuser->state = $new_state;
        //保存修改后的结果
        $adminuser->save();

        //跳转
        alert('切换成功');
        return back();
    }

}
