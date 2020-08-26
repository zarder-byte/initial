@extends('admin.layouts.app')

@section('title')
上傳-文件管理
@endsection

@section('sidebar')
@include('admin.file.menu')
@endsection

@section('content')
@page_title(['title'=>'文件','conment'=>'上傳你的文件'])

@endpage_title()
<div class="row">
    <div class="col-12">
        <form method="post" action="{{route('admin.file.up')}}" enctype="multipart/form-data" >
            @csrf
            <div class="form-group row">
                <label class="col-2 col-form-lable">选择文件</label>
                <div class="col-10">
                    <input type="file" class="form-control-file" name="filename" />
                    @error('filename')
                        <small class="form-text text-danger">{{$message}}</small>
                    @else
                        <samll class="form-text text-muted">支持{{implode(",",config("project.upload.files"))}}的类型</samll>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-2"></div>
                <div class="col-10">
                    <button type="submit" class="btn-sm btn-primary">上传</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
