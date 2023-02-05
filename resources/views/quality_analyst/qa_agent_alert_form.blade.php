@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

            <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <form action="qa_agent_alert_form" method="post">
                    @csrf

                    <div class="col-md-12 text-center">

                     <input hidden  name="title" value="Agent Alert Form">Agent Alert Form</h2>

                    </div>

                    <div class="row">
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Date</label>
                          <input  type="datetime-local" value="<?php echo date("d-m-Y H:i:s");?>" class="form-control" name="date" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Agent name</label>
                          <input type="text" class="form-control" placeholder="Agent name ..." name="agent_name" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Supervisor name</label>
                          <input type="text" class="form-control" placeholder="Supervisor name ..." name="supervisor_name">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>QA name</label>
                          <input type="text" class="form-control" placeholder="QA name ..." name="qa_name" >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Description of the Problem:</label>
                          <input class="form-control" rows="2" placeholder="Enter Description ..." name="description">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="form-group">
                          <label>Fatal Error committed:</label>
                          <input class="form-control" rows="2" placeholder="Enter Error committed ..." name="fatal_error" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                          <div class="form-group">
                            <label>Comments by the supervisor:</label>
                            <input class="form-control" rows="2" placeholder="Enter Error committed ..." name="supervisor_comment" >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>QA name</label>
                            <input type="text" class="form-control" placeholder="Supervisor name ..." name="qa_name2" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input type="text" class="form-control" placeholder="Agent name ..." name="qa_signature">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">

                            <label>Date</label>
                            <input type="datetime-local" class="form-control" name="date_by_qa2" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Supervisor name</label>
                            <input disabled value="supname"  type="text" class="form-control" placeholder="Supervisor name ..." name="supervisor_name" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input  type="text" class="form-control" placeholder="signature" name="supervisor_signature2" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input type="datetime-local" value="<?php echo date("d-m-Y H:i:s");?>" class="form-control" name="date_by_supervisor2"  >
                          </div>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="form-group" name="acknowledge">
                            <p>By signing this form, I acknowledge that I understand the feedback given and consequences thereof. I will correct this problem from today henceforth.</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Agent name</label>
                            <input type="text" class="form-control" placeholder="agent name ..." name="agent_name" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input type="text" class="form-control" placeholder="agent_sign" name="agent_signature2" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input type="datetime-local" class="form-control" name="date_by_agent2" >
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Submit</button>

                      </div>
                  </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

@stop
