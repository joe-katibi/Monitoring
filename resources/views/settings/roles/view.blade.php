@extends('adminlte::page')

@section('title', 'Permissions View | Roles')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="pull-left">Permissions <small> View Role Permissions</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/settings/roles') }}">Roles</a></li>
                <li class="breadcrumb-item active">Permissions View</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->

@stop

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="callout callout-warning edomx-card-warning">
            <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                    Role :    <strong>{{ $role[0]->name}}</strong>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    Guard :    <strong>{{ $role[0]->guard_name}}</strong>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    Description :    <strong>{{ $role[0]->description}}</strong>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    Date Created :    <strong>{{ $role[0]->created_at}}</strong>
                </div>
                <!-- /.col -->
              </div>
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3 ">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fa fa-random"></i> Permissions
                {{-- <small class="float-right">Date: 2/10/2014</small> --}}
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->


          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped" id="role_permissionsTable">
                <thead>
                <tr>
                    <th>#</th>
                  <th>Name</th>
                  <th>Guard Name</th>
                  <th>Module</th>
                  <th>Sub Module</th>
                  <th>Description</th>
                  <th>Created</th>
                </tr>
                </thead>
                <tbody>


                    @foreach($role[0]->permissions as $key=>$row)
                    <tr data-row="{{ json_encode($row) }}" data-row-index="{{ $key }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->name }}</td>
                        <td>
                            <span class="label label-success badge badge-success">
                                {{ $row->guard_name }}
                            </span>
                        </td>
                        <td>{{ $row->module }}</td>
                        <td>{{ $row->sub_module }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s') }}</td>

                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->


@stop
@section('css')
<link rel="stylesheet" href="/css/help_custom.css">
@stop
@section('js')
<script type="text/javascript">
 $(function () {
      $('#role_permissionsTable').DataTable();
    });
</script>
@stop
