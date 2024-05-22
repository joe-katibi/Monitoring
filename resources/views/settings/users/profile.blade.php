@extends('adminlte::page')
@section('title', 'My Profile | Zuku Monitoring')
@section('content_header')
<h1 class="pull-left">My Profile</h1>
<div style="clear:both"></div>
@stop


@section('content')
<div class="card card-success">
    <div class="card-header with-border">
        <h3 class="card-title">My Profile</h3>
    </div>

<div class="card-body">
    @include('sweetalert::alert')
    @if (Session::has('message') && !Session::has('module'))
    <div class="alert alert-{{ Session::has('message_type')? Session::get('message_type'): 'success' }}">
        {{ Session::get('message') }}
    </div>
    @endif
    {!! Form::open(['url'=> 'settings/users'. ((isset($user->id) && $user->id != -1)? '/'.$user->id :
    ''),'name'=>'user_form', 'id' => 'user_form', 'method' => ((isset($user->id) && $user->id != -1)? '/'.$user->id :
    '')? 'PUT': 'POST']) !!}

    <input  type="hidden" class="form-control" name="created_by" value="{{ Auth::user()->id }}">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <fieldset>
                <legend>My Details</legend>
                <input type="hidden" name="id" value="{{ isset($id)? $id: -1  }}">

                <div class="form-group">
                    {{ Form::label('name', 'Name *') }}
                    {{ Form::text('name', old('name', $user->name), ['class' => 'form-control' , 'disabled' => 'disabled'], )}}

                </div>

                <div class="form-group">
                    {{ Form::label('username', 'Username*') }}
                    {{ Form::text('username', old('username', $user->username), ['class' => 'form-control', 'disabled' => 'disabled']) }}

                </div>

                <div class="form-group ">
                    {{ Form::label('email', 'Email *') }}
                    {{ Form::email('email', old('email', $user->email), ['class' => 'form-control', 'disabled' => 'disabled']) }}

                </div>
                <div class="form-group">
                    {{Form::label('lbl_service', 'Services *' ,['class'=>'control-label label-left'])}}
                    <div class="">
                        {{ Form::select('service', $service->pluck('service_name', 'id') , old('name', $user->services), [ 'id' => 'status','class' => 'form-control','placeholder'=>'--Select Service--', 'disabled' => 'disabled']) }}
                </div>
            </div>
                    <div class="form-group">
                        {{Form::label('lbl_country', 'Country *' ,['class'=>'control-label label-left'])}}
                        <div class="">
                            {{ Form::select('country', $country->pluck('country_name', 'id') , old('country', $user->country), [ 'id' => 'status','class' => 'form-control','placeholder'=>'--Select Service--', 'disabled' => 'disabled']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    <select class="form-control {{ $user->user_status == 1 ? 'status-activated' : 'status-inactive' }}" id="status" name="status" disabled>
                        <option value="1" {{ $user->user_status == 1 ? 'selected' : '' }}>Activated</option>
                        <option value="0" {{ $user->user_status == 0 ? 'selected' : '' }}>In Active</option>
                    </select>
                </div>
            </fieldset>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-12">
                <fieldset>
                    <legend>Roles & Security</legend>
                    <div class="form-group">
                        {{ Form::label('roles', 'Assigned Roles *',['class'=>'control-label label-left']) }}
                        {{ Form::select('roles[]', $roles->pluck('description', 'id') , old('roles', $user->model_id)  ,['class' => 'form-control select2', 'multiple' => true ,'disabled' => 'disabled' ]) }}
                    </div>

                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <div class="form-group">
                        {{ Form::label('category', 'Category *',['class'=>'control-label label-left']) }}
                        {{ Form::select('category[]', $category->pluck('category_name', 'id') , old('category_name', $user->category_id)  ,['class' => 'form-control select2', 'multiple' => true , 'disabled' => 'disabled']) }}
                    </div>

                </fieldset>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('lbl_department', 'Department *' ,['class'=>'control-label label-left'])}}
                    <div class="">
                        {{ Form::select('department', $department->pluck('description', 'id') , old('name', $user->department_id), [ 'id' => 'status','class' => 'form-control','placeholder'=>'--Select Department--', 'disabled' => 'disabled' ]) }}
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="card-footer">
        <div class="card-tools-md-12 float-left">
        <a href="{{ url('/home') }}" class="btn btn-sm  btn-warning">
            <i class="fa fa-arrow-left"></i> Back
        </a>
       </div>


    </div>
    {!! Form::close() !!}
@stop

@section('css')
<link rel="stylesheet" href="/css/help_custom.css">

<style>
    .subsciber-info {
        top: 50%;
    }

</style>

<style>
        .status-activated {
        color: green;
    }
    .status-inactive {
        color: red;
    }
    select[disabled] {
        background-color: #e9ecef; /* Bootstrap's default color for disabled elements */
        color: #6c757d; /* Bootstrap's default color for disabled text */
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
