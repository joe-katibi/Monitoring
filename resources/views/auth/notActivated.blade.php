@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
@endif

@section('auth_header', __('Welcome to Zuku Monitoring'))
@include('sweetalert::alert')
@section('auth_body')
<div class="container">
    <div class="alert alert-danger">
        <strong>Your account is not activated!</strong> Please contact the administrator to activate your account.
    </div>
    <div class="alert alert-success">
        If your account has been activated,just refresh this page to login.
    </div>
</div>
@stop

@section('auth_footer')

@stop
