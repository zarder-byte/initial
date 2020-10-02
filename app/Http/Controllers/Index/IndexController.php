<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //用户访问首页
    public function index(Course $course,Chapter $chapter){
        $data = [
            'courses' => $course->orderby('sort','asc')->get(),
        ];
        return view('index/index',$data);
    }

}
