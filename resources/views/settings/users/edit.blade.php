@extends('adminlte::page')
@section('title', 'Users - All Users')
@section('content_header')
<h1 class="pull-left">Users<small> All Users</small></h1>
<div style="clear:both"></div>
@stop


@section('content')
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Edit User</h3>
    </div>
    @include('settings.users.form')
</div>
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Other Permissions</h3>
    </div>
    <div class="card-body">
        @if (Session::has('message') && Session::has('module'))
        <div class="alert alert-{{ Session::has('message_type')? Session::get('message_type'): 'success' }}">
            {{ Session::get('message') }}
        </div>
        @endif
        {!! Form::open(['url'=> 'settings/users/'. $user->id .'/permissions','name'=>'user_permissions_form', 'id' =>
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
            <div class="row col-md-12" id="user_permissions"></div>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-right">
            <button id="submit_form" type="submit" class="btn btn-sm edomx-brown text-white">
                <i class="fa fa-save"></i> Save
            </button>
        </div>
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
    .subsciber-info {
        top: 50%;
    }

</style>
@stop

@section('js')
<script src="{{asset('js/axios.min.js')}}"></script>
<script type="text/javascript">
    let userPermissions = JSON.stringify(' {{ json_encode($user_permissions) }} ');
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
                $("#user_permissions").html("");
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
                        console.log(e);
                    }).then(() => {
                        console.log("ssjsj");
                    })
                }
            }

            function updatePermissions(permissions) {
                $("#user_permissions").html("");
                let html = "";
                for (let i = 0; i < permissions.length; i++) {
                    let permission = permissions[i];
                    html += '<div class="form-group col-md-6 row">';
                    html += '<input type="checkcard" name="permissions[]" class="col-md-1 permission" ';
                    if (userHasPermission(permission)) {
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
                $("#user_permissions").html(html);
            }

            function userHasPermission(permission) {
                let hasPermission = userPermissions.filter(function (rolePermission) {
                    return rolePermission.name == permission.name;
                });
                return hasPermission.length > 0;
            }


</script>
@stop
