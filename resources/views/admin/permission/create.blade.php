@extends('adminlte::page')

@section('title', 'Create Permission')

@section('content_header')
    <h1>Create Permissions</h1>
@stop

@section('content')
 <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create</h3>
      </div>
        <!-- /.card-header -->
         <!-- form start -->
        <form action="{{ route('permission.store') }}" method="POST">
        @csrf
         <div class="card-body">
          <div class="form-group">
            <label for="role" class="h4">Permission Name</label>
            <input type="text" id="name" name="name"class="form-control"  placeholder="name">
            <span style="color:red">@error('name'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="role" class="h4">Description</label>
            <input type="text" id="description" name="description"class="form-control"  placeholder="description">
            <span style="color:red">@error('name'){{ $message }}@enderror</span>
        </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
  <!-- /.card -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop