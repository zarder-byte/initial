@extends('index.layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">所有课程</li>
@endsection

@section('content')
<div class="row">
    @foreach($courses as $course)
    <div class="col-6 mb-3">
        <div class="media">
            <img src="{{$course->image_link}}" alt="John Doe" class="mr-3 img-fluid rounded" style="width:200px;">
            <div class="media-body">
            <h4><a href="{{route('course.index',[$course->id])}}">{!!$course->title!!}</a></h4>
            <p class='text-muted'>{!!$course->desc!!}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('sidebar')
我是侧边栏
@endsection
