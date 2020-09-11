@extends('index.layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('course.index',[$course->id])}}">{{$course->title}}</a></li>
<li class="breadcrumb-item active">{{$resource->title}}</li>
@endsection

@section('title')
管理员管理
@endsection

@section('sidebar')
我是侧边栏
@endsection

@section('content')
<div class="row">
    <div class="col-12">

    <h3 class='text-center'>{{$resource->title}}</h3>
    <p class='text-muted text-sm border-bottom pb-2 d-flex'>
        <span><i class='fa fa-angle-right'></i> {{$resource->desc}}</span>
        <span class='ml-auto'>{{$resource->updated_at}}</span>
    </p>

        @if($resource->type==\App\Models\Resource::VIDEO)
            123
        @endif

        @if($resource->type==\App\Models\Resource::DOC)
            456
        @endif
    </div>
</div>

@endsection
