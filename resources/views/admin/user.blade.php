@extends('adminlte::page')

@section('title', 'Users | Zuku Monitoring')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')
@include('sweetalert::alert')


    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Users Management">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('users.create') }}" type="button" class="btn btn-success float-right" > Create User</a>
                </div>
              </div>
        </div>
                <div class="card-body">
                        <table class="table table-bordered" id="questionsTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-capitalize">Name</th>
                                                    <th class="text-capitalize">E-mail</th>
                                                    <th class="text-capitalize">Country</th>
                                                    <th class="text-capitalize">Services</th>
                                                    <th class="text-capitalize">Category</th>
                                                    <th class="text-capitalize">Position</th>
                                                    <th class="text-capitalize">Role</th>
                                                    <th class="text-capitalize">Status</th>
                                                    <th class="text-capitalize">Created</th>
                                                   <th class="text-capitalize text-right" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Actions</th>
                                                </tr>
                                             </thead>
                                                <tbody>
                                                 @foreach($users as $user)
                                                    <tr>
                                                        <td>{{$user['name']}}</td>
                                                        <td>{{$user['email'] }}</td>
                                                        <td>{{$user['country_name']}}</td>
                                                        <td>

                                                            @if ($user['service_name'] == 'Cable')

                                                  <a disable class="badge badge-success" >Cable</a>

                                                           @else
                                                 <a disable class="badge badge-primary">DTH</a>

                                                              @endif

                                                        </td>
                                                        <td>{{$user['category_name']}}</td>
                                                        <td>{{$user['position'] }}</td>
                                                        <td>roles</td>
                                                        <td>
                                                            {{-- {{$user['user_status'] }} --}}

                                                            @if ($user->s_id == '1')
                                                            <a disable class="badge badge-success" >Active</a>
                                                            @else
                                                            <a disable class="badge badge-danger" >Inactive</a>
                                                            @endif

                                                        </td>
                                                        <td>{{$user['created_at']}}</td>
                                                        <td class="text-right" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                                                        <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('users.edit',$user['id']) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                                        <a href="{{ route('users.show',$user['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        @method('DELETE')
                                                         <a id="document" href="{{ route('users.destroy',$user['id']) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                         </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                        </table>
                            </div>
      </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script src="sweetalert2.all.min.js"></script>
<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script>


@stop
