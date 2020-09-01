@extends('index.layouts.app')

@section('title')
首页
@endsection

@section('content')
我是内容
{!! config('project.admin.state')[1] !!}
@endsection

@section('css')

@endsection

@section('js')

@endsection
