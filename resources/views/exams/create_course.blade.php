@extends('adminlte::page')

@section('title', 'Create Course')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form action="{{route('create_course.store')  }}" method="POST">
  @csrf
    <div class="card card-success " >
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Create Course">
        </div>
    <div class="card-body">
      <div class="form-group">
        <label>Course Name</label>
        <div >
        <input type="text" class="form-control" name="course_name" placeholder="Enter course name" value="{{ old('course_name') }}">
        <span style="color:red">@error('course_name'){{ $message }}@enderror</span>
      </div>
      </div>
      </div>
       <!-- /.card-body -->

     <div class="card-footer">
      <button type="submit" class="btn btn-success float-right">Submit</button>
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
