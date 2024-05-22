@extends('adminlte::page')
@section('title', 'Users - New User')
@section('content_header')
<h1 class="pull-left">Users<small> New User</small></h1>
<div style="clear:both"></div>
@stop


@section('content')
<div class="card card-success"">
    <div class="card-header with-border">
        <h3 class="card-title">New User</h3>
    </div>
    @include('settings.users.form')
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/help_custom.css">
<style>
    .subsciber-info {
        top: 50%;
    }

</style>
<!-- Custom CSS for Select2 -->
<style>
    .select2-container--default .select2-selection--multiple {
        background-color: #e9ecef; /* Grey background */
        border: 1px solid #ced4da; /* Default border */
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff; /* Blue background for selected items */
        color: white; /* White text */
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white; /* White color for remove icon */
    }
</style>
@stop

@section('js')
<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
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
