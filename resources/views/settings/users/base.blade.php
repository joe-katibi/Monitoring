@extends('adminlte::page')

@section('title', 'System Configuration | Users')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="pull-left">User <small> Create</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Users</a></li>
                <li class="breadcrumb-item active">User Create</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="row">

        <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
            @include('settings.users.navigation')
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            @yield('child-content')
        </div>
</div>
@stop

@section('css')
<style>
    .user-block .username,
    .user-block .description,
    .user-block .comment {
        margin-left: 0 !important;
    }


</style>
@stack('stack_css')
@stop

@section('js')
@stack('stack_js')
@stop
