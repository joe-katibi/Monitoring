@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
  <!-- /.card -->

  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Results</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-2">
            <label>Supervisor</label>
          <input disabled type="text" class="form-control" placeholder="supervisor">
        </div>
        <div class="col-2">
            <label>Agent name</label>
          <input disabled type="text" class="form-control" placeholder="agent name">
        </div>
        <div class="col-2">
            <label>QA name</label>
          <input disabled type="text" class="form-control" placeholder="qc name">
        </div>
        <div class="col-2">
            <label>Date</label>
          <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
        </div>
        <div class="col-2">
            <label>Customer Account</label>
          <input disabled type="text" class="form-control" placeholder="Account">
        </div>
        <div class="col-2">
            <label>Recording ID</label>
          <input disabled type="text" class="form-control" placeholder="record">
        </div>
        <div class="col-2">
          <label>Achieved</label>
        <input disabled type="text" class="form-control" placeholder="achieved">
      </div>
      </div>

      <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Question</th>
            <th>Archived</th>
            <th>Percentage</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach($WelcomeCategory as $row )
            <tr>
                <td>{{$row['number']}}</td>
                <td>{{$row['question']}}</td>
                <td>archived</td>
                <td>percentage</td>

          </tr>
           @endforeach
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.card-body -->

                <!-- form start -->
                <form class="form-horizontal">
                  <div class="card-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Feedback From QC</label>
                            <input disabled class="form-control float-center" rows="3" placeholder="Enter ...">
                          </div>
                          <div class="col">
                            <label>Feedback From Supervisor</label>
                            <input disabled class="form-control float-center" rows="3" placeholder="Enter ...">
                          </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                        <label>Agent Comments</label>
                        <input class="form-control float-center" rows="3" placeholder="Enter ...">
                      </div>

              </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                  <!--  <button type="submit" class="btn btn-success float-right">Save & Finish</button> -->
                  <a href="/agent/agent_alert_form" class="btn btn-danger float-left"  > update Alert Form</a>


                  <!-- To Do save from controller and the redrect -->
                    <a href="/agent/agent_view_results" class="btn btn-success float-right"  > Save Comments</a>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->
  </div>
  <!-- /.card -->




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
