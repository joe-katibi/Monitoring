@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden>View exams Results</h1>
@stop

@section('content')
<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="View exams Results">
        </div>

    </div>
</form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
