@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')
@include('sweetalert::alert')

<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Create User">
    </div>
    <div class="card-body">
<form  action="{{ route('users.store') }}" method="POST" >
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label>User Name</label>
          <input type="text" name="name" class="form-control" placeholder="name">
        </div>
        <div class="col-3">
            <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="email">
        </div>
        <div class="col-3">
            <label>Country</label>
          <select class="custom-select"id="country" name="country" data-placeholder="select">
            @foreach ($country as $countries)
            <option value="{{$countries['name']}}">{{$countries['name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-3">
            <label>Position</label>
          <select class="custom-select"id="position" name="position" data-placeholder="select">
            @foreach ($position as $positions)
            <option value="{{$positions['name']}}">{{$positions['name']}}</option>
            @endforeach
            </select>
        </div>
      </div>

    <div class="row">

        <div class="col-3">
            <label>Service</label>
            <select class="custom-select"id="services" name="services" data-placeholder="select">
            @foreach ($service as $services)
            <option value="{{$services['id']}}">{{$services['service_name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-3">
            <label>Category</label>
            <select class="custom-select"id="category" name="category" data-placeholder="select">
            @foreach ($category as $categories)
            <option value="{{ $categories['id'] }}">{{$categories['category_name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-3">
            <div class="form-group">
             <label>Role</label>
             <select class="custom-select"id="role" name="role" data-placeholder="select">
                @foreach ($roles as $role)
                <option value="{{$role['name']}}">{{$role['name']}}</option>
                @endforeach
                </select>
             </div>
           </div>
      </div>

    <div class="col">
   <button type="submit" class="btn btn-success float-right"name="submit_filter"><strong>Create User</strong></button>
    </div>

</form>
</div>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
