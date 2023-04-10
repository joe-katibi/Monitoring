@extends('settings.users.base')
@section('title', 'System Configuration | New User')
@section('child-content')
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header with-border">
            <h3 class="card-title">New User</h3>
        </div>
        @include('settings.users.form')
    </div>
</div>
@stop
@push('stack_css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="{{ asset('js/jquery-ui/jquery-ui.min.css') }}">

<style>
    .subsciber-info {
        top: 50%;
    }
</style>
@endpush

@push('stack_js')
<script type="text/javascript" src="{{ asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        });
</script>
@endpush
