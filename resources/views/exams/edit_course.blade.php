@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden >Edit course</h1>
@stop

@section('content')
@include('sweetalert::alert')

<form action="{{ route('create_course.update',$course['id']) }}" method="POST">
    @csrf
      <div class="card card-success " >
          <div class="card-header">
              <input readonly class="form-control" style="color: green" name="category" value="Edit Course">
          </div>
      <div class="card-body">
        <div class="form-group">
          <label>Course Name</label>
          <div >
          <input type="text" class="form-control" name="course_name" placeholder="Enter course name" value="{{ $course->course_name }}">
          <span style="color:red">@error('course_name'){{ $message }}@enderror</span>
        </div>
        </div>
        </div>
         <!-- /.card-body -->
       @can('view-edit-course-button')
       <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">Update Course Name</button>
        </div>
      </div>
        @endcan

  </form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
