@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">我的留言板</h1>
        <p class="lead">根据laravel6.x所做的简易留言板，用于laravel入门理解</p>
    </div>

    <form action="{{route('save')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                @endif              
                <div class="form-group">
                    <textarea id="content" name="content" class="form-control" rows="4"></textarea>
                    <script>
                        var editor = new Simditor({
                            textarea: $('#content')
                            //optional options
                        });
                    </script>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                        <input name="username" class="form-control" type="text" />
                </div>
            </div>
            <div class="col-9">
                <div class="form-group text-right">
                    <input class="btn btn-primary" type="submit" value="提交" />
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-12">
        @foreach ($msgs as $msg)
            <div class="border rounded p-2 mb-2">
                <div class="text-primary">{{$msg->username}}</div>
                <div>{!! $msg->content !!}</div>
            </div>
        @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            {{ $msgs->links() }}
        </div>
    </div>

    <!--<div class="card ">
        <div class="card-header">Header</div>
        <div class="card-body">Content</div>
        <div class="card-footer text-right">2020-03-09-12:50</div>
    </div>-->

</div>
@endsection