@extends('adminlte::page')
@section('title', 'Permissions | Zuku Monitoring')
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="pull-left">Permissions<small>view All Permissions</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Permissions</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="card card-success ">
    <div class="card-header with-border">
        <h3 class="card-title">
            <i class="fa fa-users"></i>
            Permissions
        </h3>
        <div class="card-tools">

        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="permissions_table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Module</th>
                    <th>Sub-Module</th>
                    <th>Guard</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $key=>$row)
                <tr data-row="{{ json_encode($row) }}" data-row-index="{{ $key }}">
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->module }}</td>
                    <td>{{ $row->sub_module }}</td>
                    <td>
                        <span class="label label-success badge badge-success">
                            {{ $row->guard_name }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
@section('css')
<link rel="stylesheet" href="/css/help_custom.css">
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
            $('#permissions_table').DataTable({
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
        });
</script>
@stop
