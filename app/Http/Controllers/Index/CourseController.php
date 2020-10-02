<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index(Course $course,Chapter $chapter){
        $data = [
            'course' => $course,
        ];
        return view('index.course.index',$data);
    }


    public function resource(Course $course,Resource $resource){
        $data = [
            'course' => $course,
            'resource' => $resource,
        ];
        return view('index.course.resource',$data);
    }

}
