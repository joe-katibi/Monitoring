@extends('adminlte::page')

@section('title', 'Team Leader View Results | Zuku Monitoring')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
  <!-- /.card -->

  <div class="card card-success">
    <div class="card-header">
      <input readonly class="form-control" style="color: green" name="category" value="Agents Results">
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <label>Supervisor</label>
              <input readonly type="text" class="form-control" placeholder="supervisor" value="{{ $audit_agent[0]['SupervisorName'] }}">
            </div>

            <div class="col-2">
                <label>Agent name</label>
              <input readonly type="text" class="form-control" placeholder="agent name" value="{{ $audit_agent[0]['agentName'] }}">
            </div>
            <div class="col-2">
                <label>QA name</label>
              <input readonly type="text" class="form-control" placeholder="qc name" value="{{ $audit_agent[0]['qualityName']}}">
            </div>
            <div class="col-2">
                <label>Date</label>
              <input readonly class="form-control" value="{{ $audit_agent[0]['date_recorded'] }}" >
            </div>
            <div class="col-2">
                <label>Customer Account</label>
              <input readonly type="text" class="form-control" placeholder="Account" value="{{ $audit_agent[0]['customer_account'] }}">
            </div>
            <div class="col-2">
                <label>Recording ID</label>
              <input readonly type="text" class="form-control" placeholder="record" value="{{ $audit_agent[0]['recording_id'] }}" >
            </div>
            <div class="col-2">
              <label>Total Marks</label>
            <input readonly type="text" class="form-control" placeholder="archived" value="{{ $audit_agent[0]['final_results'] }}%">
          </div>
          </div>

      <div class="card-body">
      <table class="table table-bordered" id="questionsTable">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Question</th>

            <th>Percentage</th>
          </tr>
        </thead>
        <tbody>
            @foreach($audit_agent as $row )
            <tr>
                <td>{{$row['number']}}</td>
                <td>{{$row['question']}}</td>
                <td>{{$row['marks']}} %</td>

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
                            <input readonly class="form-control float-center" rows="3" placeholder="Enter ..." value="{{$audit_agent[0]['feedback_from_qc'] }}">
                          </div>
                          <div class="col">
                            <label>Feedback From Supervisor</label>
                            <input readonly  class="form-control float-center" rows="3" placeholder="Enter ..." value="{{$audit_agent[0]['supervisor_comment'] }}">
                          </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                        <label>Feedback From Agent</label>
                        <input readonly class="form-control float-center" rows="3" placeholder="Enter ..."value="{{$audit_agent[0]['agent_comment'] }}">
              </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
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
{{-- <script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script> --}}
@stop
