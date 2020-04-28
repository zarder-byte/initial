@extends('admin.layouts.app')

@section('content')

<?php
dump(Auth::guard('admin')->user());
dump(Auth::guard('admin')->check());

?>

@endsection