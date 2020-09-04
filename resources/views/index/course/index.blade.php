@extends('index.layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">{{$course->title}}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-6 mb-3">
        <div class="media">
            <img src="{{$course->image_link}}" alt="John Doe" class="mr-3 img-fluid rounded" style="width:200px;">
            <div class="media-body">
            <h4>{!!$course->title!!}</h4>
            <p class='text-muted'>{!!$course->desc!!}</p>
            </div>
        </div>
    </div>

    <div class="col-12">
        @foreach($course->chapter as $chapter)
        <div class="row mt-2 mb-3">
            <div class='col-12'>
                <div class='d-flex mb-2'>
                    <h5 class='m-0 p-0'><i class="fa fa-angle-down"></i>({{$chapter->sort}}) {!!$chapter->title!!}</h5>
                    <small class="text-muted mr-auto pl-2 align-middle" style='margin:auto 0;'>
                        {{$chapter->desc}}
                    </small>
                </div>
            </div>

            @foreach($chapter->resource as $resource)
            <div class="col-12">
                <div class="list-group"><!--list-group-item 列表组 -action 鼠标悬停显示灰色背景 -->
                    <div class="list-group-item list-group-item-action  d-flex">
                        {!!$resource->typeName!!}&nbsp;&nbsp;-&nbsp;&nbsp;
                            <a href="#" title="{{$resource->desc}}">
                                {{$resource->title}}
                            </a> <!-- ml-auto 元素居右 mr-auto 元素居左 -->
                    <span class="ml-auto text-muted text-sm">{{$resource->updated_at}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>

</div>
@endsection

@section('sidebar')
我是侧边栏
@endsection
