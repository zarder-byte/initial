@extends('admin.layouts.guest')

@section('title')
管理员登陆
@endsection

@section('content')
<div class="row">
    <div class="offset-3"></div>
    <div class="col-6 mt-5 p-5 bg-light rounded">
        <h4>管理员登陆</h4>
        <form method="post" action="{{route('admin.login')}}">
            @csrf
        <div class="form-group row">
            <label for="username" class="col-2 col-form-label">username</label>
            <div class="col-10">
                <input type="text" name="username" class="form-control" id="username" placeholder="请输入用户名" >
                <small class="form-text text-muted">
                    @error('username')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </small>
            </div>
        </div>

        <div class="form-group row">
            <label for="username" class="col-2 col-form-label">password</label>
            <div class="col-10">
                <input type="text" name="password" class="form-control" id="password" placeholder="请输入用户名" >
                <small class="form-text text-muted">
                    @error('password')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </small>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-2"></div>
            <div class="col-10">
                <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
        </div>
        </form>

    </div>
</div>
@endsection