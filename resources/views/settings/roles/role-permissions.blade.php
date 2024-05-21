@extends('adminlte::page')

@section('title', 'System Configuration | Roles | Zuku Monitoring')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="pull-left">Roles - Permissions <small> Manage User Roles</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/settings/roles') }}">Roles</a></li>
                <li class="breadcrumb-item active">Roles - Permissions </li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->

@stop

@section('content')
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Permissions - <strong>{{ $role->description }}</strong></h3>
    </div>
    <div class="card-body">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::has('message_type')? Session::get('message_type'): 'success' }}">
            {{ Session::get('message') }}
        </div>
        @endif
        {!! Form::open(['url'=> 'settings/roles/'. $role->id .'/permissions','name'=>'role_permissions_form', 'id' =>
        'role_permissions_form',
        'method' => 'POST']) !!}
        <div class="row">
            <div class="form-group col-md-6">
                {{ Form::label('module', 'Module') }}
                {{ Form::select('module', [],'',['class'=> 'form-control select2','id' => 'module_permissions',
                'placeholder' => '---Select Module---']) }}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('sub_module', 'Sub-Module') }}
                {{ Form::select('sub_module', [],'',['class'=> 'form-control select2', 'id' => 'sub_module_permissions',
                'placeholder' => '---Select Sub-Module---']) }}
            </div>
        </div>
        <div class="row">
            <div class="row col-md-12" id="role_permissions"></div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url('settings/roles') }}" class="btn btn-default btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <button id="submit_form" type="submit" class="btn btn-sm btn-info float-right">
            <i class="fa fa-check"></i> Save
        </button>

        <div class="pull-right" id="changes_unsaved_message" style="padding-right: 8px;">
            <span class="help-block center-block">Unsaved changes</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
@section('css')
<link rel="stylesheet" href="/css/help_custom.css">
<style>
    .col-md-1 {
    max-width: 2.333333% !important;
    margin-left: 2%;
    }
</style>
@stop
@section('js')
<script src="{{asset('js/select2.full.min.js') }}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script type="text/javascript">
    let rolePermissions = JSON.parse('<?php echo json_encode($role_permissions) ?>');
        let selectedModule = '{{Session::get('module') }}';
        let selectedSubModule = '{{  Session::get('sub_module') }}';

        $(document).ready(function () {
            $(".select2").select2();

            $("#module_permissions").on('change.select2', function (e) {
                fetchPermissionSubModules($("#module_permissions").val());
            });

            $("#sub_module_permissions").on('change.select2', function (e) {
                fetchPermissions($("#module_permissions").val(), $("#sub_module_permissions").val());
            });

            $("#changes_unsaved_message").hide();

            $(".permission").on('change', function (e) {
                $("#changes_unsaved_message").show();
            });
            fetchPermissionModules();
        });

        function fetchPermissionModules() {
            axios.get('{{ url('settings/permissions/modules') }}')
                .then(response => {
                    updateModules(response.data)
                }).catch(e => {
            }).then(() => {
            })
        }

        function fetchPermissionSubModules(module) {
            axios.get('{{ url('settings/permissions/modules') }}/' + module + '/sub-modules')
                .then(response => {
                    updateSubModules(response.data)
                }).catch(e => {
            }).then(() => {
            })
        }

        function updateModules(modules) {
            for (let i = 0; i < modules.length; i++) {
                const option = new Option(modules[i], modules[i], false, false);
                $('#module_permissions').append(option);
            }
            if (selectedModule != null) {
                $('#module_permissions').val(selectedModule).trigger('change')
            }
        }

        function updateSubModules(subModules) {
            $("#role_permissions").html("");
            $('#sub_module_permissions').empty().trigger("change");
            const placeholder = new Option("---Select Sub-Module---", "", false, false);
            $('#sub_module_permissions').append(placeholder);
            for (let i = 0; i < subModules.length; i++) {
                const option = new Option(subModules[i], subModules[i], false, false);
                $('#sub_module_permissions').append(option);
            }
            if (selectedSubModule != null) {
                $('#sub_module_permissions').val(selectedSubModule).trigger('change')
            }
        }

        function fetchPermissions(module, subModule) {
            if (module && subModule) {
                axios.get('{{ url('settings/permissions/filter') }}', {
                    params: {
                        module: module,
                        sub_module: subModule
                    }
                }).then(response => {
                    updatePermissions(response.data)
                }).catch(e => {
                }).then(() => {
                })
            }
        }

        function updatePermissions(permissions) {
            $("#role_permissions").html("");
            let html = "";
            for (let i = 0; i < permissions.length; i++) {
                let permission = permissions[i];
                html += '<div class="form-group col-md-6 row">';
                html += '<input type="checkbox" name="permissions[]" class="col-md-1 permission" ';
                if (roleHasPermission(permission)) {
                    html += 'checked';
                }
                html += ' value="' + permission.name + '"';
                html += '>';
                html += '<dl class="col-md-10">';
                html += '<dt>' + permission.description + '</dt>';
                html += '<dd>' + permission.name + '</dd>';
                html += '</dl>';
                // html += permission.description;
                html += '</input>';
                html += '</div>'

            }
            $("#role_permissions").html(html);
        }

        function roleHasPermission(permission) {
            let hasPermission = rolePermissions.filter(function (rolePermission) {
                return rolePermission.name == permission.name;
            });
            return hasPermission.length > 0;
        }
</script>
@stop
