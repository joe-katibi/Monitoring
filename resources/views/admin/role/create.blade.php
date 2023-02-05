@extends('adminlte::page')

@section('title', 'Create Roles')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')
 <div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Create Roles">
      </div>
        <!-- /.card-header -->
         <!-- form start -->
        <form action="{{ route('roles.store') }}" method="POST">
        @csrf
         <div class="card-body">
          <div class="form-group">
            <label for="role" class="h4">Role Name</label>
            <input type="text" id="name" name="name"class="form-control"  placeholder="name">
            <span style="color:red">@error('name'){{ $message }}@enderror</span>
        </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Assign Permissions</label>
              <select  name="permissions" id="permissions" class="select2" multiple="multiple" placeholder="Select a Permission" style="width: 100%;">
                {{-- <option disabled selected>Assign Permissions</option> --}}
                @foreach($permissions as $permission)
                <option value="{{$permission['description']}}" >{{$permission['description']}}</option>
                @endforeach
              </select>
            <span style="color:red">@error('assign Permissions'){{ $message }}@enderror</span>
          </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">Create Role</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
  @include('sweetalert::alert')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('permissions')  // id
    </script>
@stop
