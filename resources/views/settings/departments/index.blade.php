
@extends('adminlte::page')
@section('title', 'Departments | Zuku Monitoring')
@section('content_header')
@include('sweetalert::alert')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="pull-left">Departments<small> All Departments</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Departments</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="card card-outline edomx-card-warning">
    <div class="card-header with-border">
        <h3 class="card-title">All Departments</h3>
        @can('view-add-departments')
        <div class="card-tools">
            <a href="#modal_add_department" data-toggle="modal" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>
                ADD </a>
        </div>
        @endcan
    </div>

    <div class="card-body">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::has('message_type')? Session::get('message_type'): 'success' }}">
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="table-responsive">
            <table id="departmentsTable" class="table no-margin">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $key=> $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$row->department_name}}</td>
                        <td>{{$row->description}}</td>
                        <td>{{ !empty($row->creator_name) ? $row->creator_name->name : 'Admin' }}</td>
                        <td>{{$row->created_at}}</td>
                        <td>
                            @can('view-edit-delete-departments')

                                <a href="#modal_edit_department" data-toggle="modal" class="btn btn-sm btn-info edit-button" data-rowid="{{ $row->id }}" data-departmentname="{{ $row->department_name }}" data-description="{{ $row->description }}">
                                    <i class="fa fa-edit"></i> EDIT
                                </a>


                            {{-- <a href="{{ url('settings/department/'. $row->id .'/edit') }}"
                                data-row="{{  json_encode($row) }}"
                                class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash-alt"></i> Delete
                            </a> --}}
                            @endcan
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
@include('settings.departments.modals.modal_add_department')
@include('settings.departments.modals.modal_edit_department')
{{-- @include('modals.departments.modal_delete_department') --}}
@stop
@section('css')
<link rel="stylesheet" href="/css/help_custom.css">
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
@stop
@section('js')

{{-- <script src="/js/select2.full.min.js"></script> --}}

<script>
    $(function () {
      $(".select2").select2();
      $('#departmentsTable').DataTable();
    });
</script>


<script>
    $(document).ready(function() {
        $('.edit-button').click(function() {
            // Get the data attributes from the clicked button/link
            var rowId = $(this).data('rowid');
            var departmentName = $(this).data('departmentname');
            var description = $(this).data('description');

            // Set the values inside the modal form fields
            $('#modal_row_id').text(rowId);
            $('#modal_department_name').val(departmentName);
            $('#modal_description').val(description);
            $('#modal_row_id').val(rowId);
        });
    });
</script>


@stop
