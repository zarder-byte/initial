@extends('admin.layouts.app')

@section('title')
管理员管理
@endsection

@section('sidebar')
@include('admin.course.menu')
@endsection

@section('content')
@page_title(['title'=>'课程添加','conment'=>'管理你的课程'])

@endpage_title()

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.course.chapter.add',[$course->id, $chapter->id ])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-2 col-form-label">标题</label>
                <div class="col-10">
                    <input type="text" class="form-control" name='title' value='{{old("title",$chapter->title)}}'>
                    @error('title')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">简介</label>
                <div class="col-10">
                    <textarea class="form-control" name='desc'>{{old("desc",$chapter->desc)}}</textarea>
                    @error('desc')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">排序</label>
                <div class="col-10">
                    <input type="text" class="form-control" name='sort' value='{{old("sort",$chapter->sort)}}'>
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class='offset-2'></div>
                <div class="col-10">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
