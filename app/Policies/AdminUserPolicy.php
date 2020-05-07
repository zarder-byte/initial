<?php

namespace App\Policies;

use App\Models\AdminUser;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 参数1：当前登陆的用户,参数2：你要操作的数据-目标数据模型
     *
     *删除和状态切换
     */
    public function remove(AdminUser $adminuser,$targetAdminUser){
        if($targetAdminUser->id == 1){
            return Response::deny("不能对超级管理员做这个操作");
        }
        return true;
    }

    //编辑
    public function modify(AdminUser $adminuser,$targetAdminUser){
        if($targetAdminUser->id == 1){
            if($adminuser->id <> $targetAdminUser->id){
                return Response::deny("超级管理员只能由本人编辑");
            }
        }
        return true;
    }



}
