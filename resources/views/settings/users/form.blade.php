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
                <legend>User Details</legend>
                <input type="hidden" name="id" value="{{ isset($id)? $id: -1  }}">


                <div class="form-group {{ $errors->has('name')? 'has-error':''}}">
                    {{ Form::label('name', 'Name *') }}
                    {{ Form::text('name', old('name', $user->name), ['class' => 'form-control']) }}

                    @if($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('username')? 'has-error':''}}">
                    {{ Form::label('username', 'Username*') }}
                    {{ Form::text('username', old('username', $user->username), ['class' => 'form-control']) }}

                    @if($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('email')? 'has-error':''}}">
                    {{ Form::label('email', 'Email *') }}
                    {{ Form::email('email', old('email', $user->email), ['class' => 'form-control']) }}

                    @if($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    {{Form::label('lbl_service', 'Services *' ,['class'=>'control-label label-left'])}}
                    <div class="">
                        {{ Form::select('service', $service->pluck('service_name', 'id') , old('name', $user->services), [ 'id' => 'status','class' => 'form-control','placeholder'=>'--Select Service--']) }}
                </div>
            </div>
                    <div class="form-group">
                        {{Form::label('lbl_country', 'Country *' ,['class'=>'control-label label-left'])}}
                        <div class="">
                            {{ Form::select('country', $country->pluck('country_name', 'id') , old('country', $user->country), [ 'id' => 'status','class' => 'form-control','placeholder'=>'--Select Service--']) }}
                    </div>
                </div>
                <div class="form-group">
               {{ Form::label('status', 'Status') }}
              <select class="form-control" required="required" id="status" name="status">
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
                        {{ Form::select('roles[]', $roles->pluck('description', 'id') , old('roles', $user->model_id)  ,['class' => 'form-control select2', 'multiple' => true ]) }}
                    </div>

                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <div class="form-group">
                        {{ Form::label('category', 'Category *',['class'=>'control-label label-left']) }}
                        {{ Form::select('category[]', $category->pluck('category_name', 'id') , old('category_name', $user->category_id)  ,['class' => 'form-control select2', 'multiple' => true ]) }}
                    </div>

                </fieldset>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('lbl_department', 'Department *' ,['class'=>'control-label label-left'])}}
                    <div class="">
                        {{ Form::select('department', $department->pluck('description', 'id') , old('name', $user->department_id), [ 'id' => 'status','class' => 'form-control','placeholder'=>'--Select Department--' , ]) }}
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="card-footer">
        <div class="card-tools-md-12 float-left">
        <a href="{{ url('settings/users') }}" class="btn btn-sm  btn-warning">
            <i class="fa fa-arrow-left"></i> Back
        </a>
       </div>

        <div class="card-tools-md-12 float-right">
            <!-- <button id="reset-password" type="button" class="btn  btn-sm  btn-info">
                <i class="fa fa-key"></i> Reset Password
            </button> -->
            <button id="submit_form" type="submit" class="btn btn-sm btn-success">
                <i class="fa fa-save"></i> Save
            </button>
        </div>

    </div>
    {!! Form::close() !!}
</div>
@push('stack_css')
<link rel="stylesheet" href="/css/help_custom.css">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
<style>
    .subsciber-info {
        top: 50%;
    }

    .search-container {
        margin-bottom: 20px;
    }

    .row-actions {}

    .datepicker {
        border-radius: unset !important;
    }
</style>

@endpush

@push('stack_js')
<script src="https://oss.maxcdn.com/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"
    integrity="sha256-4F7e4JsAJyLUdpP7Q8Sah866jCOhv72zU5E8lIRER4w=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {

            $(".select2").select2();

            $("#reset-password").click(function (e) {
                var btn = $(this);
                var user = JSON.parse('<?php  echo json_encode($user); ?>');
                bootbox.confirm({
                    message: "A password reset email will be sent to the user to reset their password. Proceed?",
                    title: "Reset password",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            btn.attr("disabled", true);
                            window.location.href = '{{ url('settings/users/') }}' + '/' + user.id + '/reset-password';
                        }
                    }
                });
            });


            $('#user_form').bootstrapValidator({
                // Only disabled elements are excluded
                // The invisible elements belonging to inactive tabs must be validated
                excluded: [':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    code: {
                        validators: {
                            notEmpty: {
                                message: 'Enter user code'
                            },
                            stringLength: {
                                min: 3,
                                max: 3,
                                message: 'The code must be 3 characters long'
                            },
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Enter username'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Enter email'
                            },
                            email: {
                                message: 'Enter valid email'
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Enter name'
                            }
                        }
                    },
                }
            }).on('init.form.bv', function (e, data) {
                $("#submit_form").attr("disabled", "disabled");
            }).on('error.form.bv', function (e) {
                $("#submit_form").attr("disabled", "disabled");
            }).on('success.form.bv', function (e) {
                $("#submit_form").removeAttr("disabled");
            });

        });

</script>
<script type="text/javascript">
    document.getElementById("user_code").addEventListener("keypress", forceKeyPressUppercase, false);
        document.getElementById("user_code").addEventListener("change", forceKeyPressUppercase, false);

        function forceKeyPressUppercase(e) {
            const charInput = e.keyCode;
            if ((charInput >= 97) && (charInput <= 122)) { // lowercase
                if (!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
                    const newChar = charInput - 32;
                    const start = e.target.selectionStart;
                    const end = e.target.selectionEnd;
                    e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
                    e.target.setSelectionRange(start + 1, start + 1);
                    e.preventDefault();
                }
            }
        }
</script>
@endpush
