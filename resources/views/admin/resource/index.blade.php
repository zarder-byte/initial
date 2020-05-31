@extends('admin.layouts.app')

@section('title')
管理员管理
@endsection

@section('sidebar')
@include('admin.resource.menu')
@endsection

@section('content')
@page_title(['title'=>'课程资源','conment'=>'你的课程资源数据中心'])

@endpage_title()
<div class="row">
    <div class="col-12">
    <form method="get" action="{{route('admin.resource')}}">
        <div class="form-row">
            <div class="col-auto">
                <input type="text" name="keyword"  class="form-control" placeholder="搜索标题" value="{{$stdclass->keyword}}">
            </div>
            <div class="col-auto">
                <input type="text" name="adminuser_id" class="form-control" placeholder="创建者id" value="{{$stdclass->adminuser_id}}">
            </div>
            <div class="col-auto">
                @foreach(config('project.resource.type') as $key=>$value)
                <div class="form-check form-check-inline align-middle">
                    <label class="form-check-label">
                    @if(!$stdclass->type)
                    <input name="type[{{$key}}]" type="checkbox" class="form-check-input" value="{{$key}}" checked
                     >{!!$value!!}
                    @else
                    <input name='type[{{$key}}]'
                        type="checkbox"
                        class="form-check-input"
                        value="{{$key}}" {{isset($stdclass->type[$key]) ? 'checked' : ''}}>{!!$value!!}
                    @endif
                    </label>
                </div>
                @endforeach
            </div>
            <div class="col-auto">
                <input type="submit" class="btn btn-primary" value="搜索">
            </div>
        </div>
    </form>
    </div>
</div>

<div class='row mt-2'>
    <div class='col-12'>
<table class="table table-sm table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">id</th>
      <th scope="col">作者</th>
      <th scope="col">类型</th>
      <th scope="col">标题</th>
      <th scope="col">创建时间</th>
      <th scope="col">管理</th>
    </tr>
  </thead>
  <tbody>
    @foreach($resources as $resource)
    <tr>
    <th scope="row">{{$resource->id}}</th>
    <th scope="row">{{$resource->adminuser->username??'-/-'}}</th>
    <th scope="row">{!!$resource->Type_Name!!}</th>
    <th scope="row">{{$resource->title}}</th>
    <th scope="row">{{$resource->created_at}}</th>
    <th scope="row">
        <a href="{{route('admin.resource.add',[$resource->id])}}" class="btn btn-sm btn-secondary">修改</a>
        <a href="{{route('admin.resource.remove',[$resource->id])}}" onclick="return confirm('确认删除吗？')" class="btn btn-sm btn-danger">删除</a>
    </th>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $resources->appends(request()->all())->links() }}
    </div>
</div>
@endsection
