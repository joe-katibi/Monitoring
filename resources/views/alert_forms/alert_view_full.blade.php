@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')

            <div class="card card-success">
                <div class="card-header">
                   <input readonly class="form-control" style="color: green" name="{{ $showalert['title'] }}" value="{{ $showalert['title'] }}">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="col-md-12 text-center">
                      <h2 name="form">{{ $showalert['title'] }}</h2>
                    </div>
                    <div class="container">
                    <div class="row">
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Date</label>
                          <input disabled value="{{ $showalert['date'] }}" class="form-control"  >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Agent name</label>
                          <input disabled  value="{{ $showalert['agent_name'] }}" type="text" class="form-control" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Supervisor name</label>
                          <input disabled  value="{{ $showalert['supervisor_name'] }}" type="text" class="form-control" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>QA name</label>
                          <input disabled  value="{{ $showalert['qa_name'] }}" type="text" class="form-control"  >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Description of the Problem:</label>
                          <input disabled  value="{{ $showalert['description'] }}" class="form-control" rows="2">
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="form-group">
                          <label>Fatal Error committed:</label>
                          <input disabled  value="{{ $showalert['fatal_error'] }}" class="form-control" rows="2"  >
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>QA name</label>
                            <input disabled  value="{{ $showalert['qa_name'] }}"  type="text" class="form-control" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled  value="{{ $showalert['qa_signature'] }}" type="text" class="form-control" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">

                            <label>Date</label>
                            <input disabled  value="{{ $showalert['date_by_qa'] }}" class="form-control"  >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm">
                          <div class="form-group">
                            <label>Comments by the supervisor:</label>
                            <input disabled  value="{{ $showalert['supervisor_comment'] }}" class="form-control" rows="2" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Supervisor name</label>
                            <input disabled  value="{{ $showalert['supervisor_name'] }}" type="text" class="form-control"  >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled  value="{{ $showalert['supervisor_signature'] }}" type="text" class="form-control" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input disabled  value="{{ $showalert['date_by_supervisor'] }}" class="form-control"  >
                          </div>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="form-group">
                            <p>By signing this form, I acknowledge that I understand the feedback given and consequences thereof. I will correct this problem from today henceforth.</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Agent name</label>
                            <input disabled  value="{{ $showalert['agent_name'] }}" type="text" class="form-control" placeholder="Supervisor name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled  value="{{ $showalert['agent_signature'] }}" type="text" class="form-control" placeholder="Agent name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input disabled value="{{ $showalert['date_by_agent'] }}" class="form-control"  >
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="card-footer">
                        {{-- <a href="{{route('category') }}" class="btn btn-success float-left"  > QA Another Call</a> --}}
                        <button type="submit" class="btn btn-success float-right">Export PDF</button>

                      </div>
                  </form>

                </div>
            </div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
