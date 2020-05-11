<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index(Setting $setting){
        $settings = $setting->orderby('sort','asc')->get();
        $data = [
            'settings' => $settings,
        ];
        return view('admin.setting.index',$data);
    }

    public function save(Request $request,Setting $setting){
        $settings = $request->input('settings');
        //dump($settings);exit;
        foreach ($settings as $key => $value) {
            $value = ($value == null ) ? '' :$value;
            $setting->where('key',$key)->update(['value'=>$value]);
        }

        alert('操作成功');
        return back();
    }
}
