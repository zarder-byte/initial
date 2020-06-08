@extends('admin.layouts.app')

@section('title')
管理员管理
@endsection

@section('sidebar')
@include('admin.course.menu')
@endsection

@section('content')
@page_title(['title'=>'课程','conment'=>'课程管理'])

@endpage_title()

@endsection
