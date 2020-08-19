@extends('admin.layouts.app')

@section('title')
上傳-文件管理
@endsection

@section('sidebar')
@include('admin.file.menu')
@endsection

@section('content')
@page_title(['title'=>'文件','conment'=>'上傳你的文件'])

<div class="row">
    <div class="col-12">

    </div>
</div>

@endpage_title()

@endsection
