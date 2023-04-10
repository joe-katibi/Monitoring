@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

{{-- <div class="panel-body">
    {{-- <form method="post" action="{{ route('exam.store', $exam->id) }}"> --}}
        {{ csrf_field() }}

        {{-- @foreach ($questions as $question) --}}
            <div class="form-group">
                <label>Question</label>
                <div class="radio">
                    <label><input type="radio" name="question_" value="A">A</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="question_" value="B">B</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="question_" value="C">C</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="question_" value="D">D</label>
                </div>
            </div>
        {{-- @endforeach --}}

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> --}}



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
