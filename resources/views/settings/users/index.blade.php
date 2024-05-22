@extends('adminlte::page')
@section('title', 'All Users | Zuku Monitoring')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="pull-left">Users<small> All Users</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Users</a></li>
                <li class="breadcrumb-item active">All Users</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">All Users</h3>
                @can('view-create-user-button')
                <!-- <div class="card-tools">
                    {{-- <a href="{{ url('') }}" class="btn btn-sm edomx-brown text-white"><i class="fa fa-plus"> </i> Create
                        User </a> --}}
                        <a href="{{ url('settings/users/create') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>
                            ADD </a>
                </div> -->
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="usersTable" class="table no-margin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <!-- <th>Country</th>
                                <th>Services</th>
                                <th>Role</th>
                                <th>Department</th> -->
                                {{-- <th>User Code</th> --}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key=> $row)

                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$row->name}}</td>
                                <td><a href="">{{$row->email}}</a></td>
                                <!-- <td>{{$row->country_name}}</td>
                                <td>

                                    @if ($row['service_name'] == 'Cable')

                          <a disable class="badge badge-success" >Cable</a>

                                   @else
                         <a disable class="badge badge-primary">DTH</a>

                                      @endif

                                </td>
                                <td>{{$row['description']}}</td>
                                <td>{{$row->department_name}}</td> -->
                                {{-- <td>{{$row->code}}</td> --}}
                                <td>
                                    @if($row->user_status == 1)
                                    <a disable class="badge badge-success" >Active</a>
                                    @else
                                    <a disable class="badge badge-danger" >Inactive</a>
                                    @endif
                                </td>
                                <td>
                                @if($row->user_status == 0)
                                    <a class="btn btn-sm btn-warning" href="{{ url('settings/users/'. $row->id .'/newUser') }}"
                                        data-row="{{ json_encode($row) }}">
                                        <i class="fa fa-user-plus"></i> Activate
                                    </a>
                                    @else
                                    <!-- <a class="btn btn-sm btn-warning" href='{{ url('settings/users/'. $row->id
                                        .'/activate') }}'
                                        data-row="{{ json_encode($row) }}">
                                        <i class="fa fa-plus-square"></i> Activate
                                    </a> -->
                                    @endif
                                    @if($row->user_status == 1)
                                    @can('view-edit-user-status')
                                    <a href="{{ url('settings/users/'. $row->id .'/edit') }}"
                                        data-row="{{  json_encode($row) }}" class="btn btn-sm btn-info">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
                                    <a class="btn btn-sm btn-danger" href='{{ url('settings/users/'. $row->id
                                        .'/deactivate') }}'
                                        data-row="{{ json_encode($row) }}">
                                        <i class="glyphicon glyphicon glyphicon-off"></i> Deactivate
                                    </a>
                                    @else
                                    <!-- <a class="btn btn-sm btn-warning" href='{{ url('settings/users/'. $row->id
                                        .'/activate') }}'
                                        data-row="{{ json_encode($row) }}">
                                        <i class="fa fa-plus-square"></i> Activate
                                    </a> -->
                                    @endif
                                    @endcan
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

    </div>
</div>
 {{-- @include('modals.users.modal_edit_user') --}}
{{-- @include('modals.users.modal_delete_user') --}}
{{-- @include('modals.users.modal_add_new_user') --}}

@stop
@section('css')
<link rel="stylesheet" href="/css/help_custom.css">

@stop
@section('js')

{{-- <script src="/js/select2.full.min.js"></script> --}}

<script>
    $(function () {
      $(".select2").select2();
      $('#usersTable').DataTable();
    });
</script>
@stop
