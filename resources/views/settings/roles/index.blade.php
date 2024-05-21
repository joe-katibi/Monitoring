@extends('adminlte::page')
@section('title', 'Roles | Zuku Monitoring')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="pull-left">Roles <small> Manage User Roles</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->

@stop
@section('content')
<div class="card card-success">
    <div class="card-header with-border">
        <h3 class="card-title">
            <i class="fa fa-users"></i>
            Roles
        </h3>
        @can('view-create-roles')
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-info" id="create_role">
                <i class="fa fa-plus"></i> Create New
            </button>
        </div>
        @endcan
    </div>
    <div class="card-body">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::has('message_type')? Session::get('message_type'): 'success' }}">
            {{ Session::get('message') }}
        </div>
        @endif
        <table class="table table-striped table-bordered" id="roles_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Guard</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $key=>$row)
                <tr data-row="{{ json_encode($row) }}" data-row-index="{{ $key }}">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['description'] }}</td>
                    <td>
                        <span class="label label-success badge badge-success">
                            {{ $row['guard_name'] }}
                        </span>
                    </td>
                    <td>
                        @can('view-edit-roles-permission')
                        <a href='#' class="btn btn-sm btn-info action_edit_role"
                            data-row="{{ json_encode($row) }}">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href='{{ url('settings/roles/' . $row['id'] . '/permissions') }}'
                            class="btn btn-warning btn-flat btn-sm action_edit_role_permissions"
                            data-row="{{ json_encode($row) }}">
                            <i class="fa fa-lock"></i> Permissions
                        </a>
                        <a href='{{ url('settings/roles/' . $row['id']  . '/view') }}'
                            class="btn btn-sm btn-success"
                            data-row="{{ json_encode($row) }}">
                            <i class="fa fa-eye"></i> View Permissions
                        </a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" role="dialog" id="role_form_modal" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header edomx-card-warning">
                <h4 class="modal-title">Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                {!! Form::open(['url'=> 'settings/roles/post','name'=>'role_form', 'id' => 'role_form',
                'method' => 'POST']) !!}
                <input type="hidden" name="id" value="-1" id="role_id">
                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{ Form::label('Name','Name:') }}
                        {{ Form::text('name',null, ['class'=>'form-control','placeholder'=>'','required'=>true,
                    'id' => 'role_name']) }}
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{ Form::label('Description','Description:') }}
                        {{ Form::text('description',null, ['class'=>'form-control','placeholder'=>'','required'=>true,
                    'id' => 'role_description']) }}
                    </div>
                </div>
                <div class="pull-right modal-actions">
                    <button type="submit" class="btn btn-sm btn-info">Save
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{--
@include('modals.roles.modal_add_new_role')
@include('modals.roles.modal_compose_mail') --}}
@stop
@section('css')
<link rel="stylesheet" href="/css/help_custom.css">
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
<style>
    .table-actions {
        margin-bottom: 20px;
    }

    .nav-tabs-custom {
        box-shadow: 0 0 0 !important;
    }

    .tab-content .tab-pane {
        padding-top: 20px;
    }

    .user-block .username,
    .user-block .description,
    .user-block .comment {
        margin-left: 0 !important;
    }
</style>
@stop
@section('js')

<script src="/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#roles_table').DataTable({
            "bScrollInfinite": true,
            "bScrollCollapse": true,
            "sScrollY": "520px",
            "pagingType": "full_numbers",
            "dom": 'lfrtip',
            "searching": true,
            "paging": true,
            "rowCallback": function (r, d) {
            }
        });

        $("#create_role").click(function (e) {
            $("#role_id").val("-1");
            $("#role_name").val("");
            $("#role_description").val("");
            // $("#scheme_active").prop('checked', true);
            $("#role_form_modal").modal('show');
        });

        $("#roles_table").on('click', '.action_edit_role', function (e) {
            const role = JSON.parse($(this).attr('data-row'));

            $("#role_id").val(role.id);
            $("#role_name").val(role.name);
            $("#role_description").val(role.description);
            // $("#scheme_active").prop('checked', true);
            $("#role_form_modal").modal('show');
        });

      /*  $("#roles_table").on('click', '.action_edit_role_permissions', function (e) {
            const role = JSON.parse($(this).attr('data-row'));

            $("#role_permissions_title").html("Role permissions (" + role.description + ')');

            $("#role_permissions_form_modal").modal('show');
        });*/
        $(".select2").select2();
      $('#example1').DataTable();
    });
</script>

@stop
