@extends('adminlte::page')

@section('title', 'Zuku Monitoring | Agents Results')

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
          <input readonly type="text" class="form-control"  value="{{$supevisorName->name}}">
        </div>
        <div class="col-2">
            <label>Agent name</label>
          <input readonly type="text" class="form-control"  value="{{$agentName->name}}">
        </div>
        <div class="col-2">
            <label>QA name</label>
          <input readonly type="text" class="form-control"  value="{{$qualityName->name}}">
        </div>
        <div class="col-2">
            <label>Date</label>
          <input readonly class="form-control" value="{{$tlactions[0]['date_recorded']}}" >
        </div>
        <div class="col-2">
            <label>Customer Account</label>
          <input readonly type="text" class="form-control" placeholder="Account" value="{{$tlactions[0]['customer_account']}}">
        </div>
        <div class="col-2">
            <label>Recording ID</label>
          <input readonly type="number" class="form-control" placeholder="record"
          value="{{$tlactions[0]['recording_id']}}"
          >
        </div>
        <div class="col-2">
          <label>Achieved</label>
        <input readonly type="text" class="form-control" placeholder="achieved" value="{{$tlactions[0]['final_results']}}%">
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
            @foreach($tlactions as $row )
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


                        <div class="col">
                            <label>Feedback From QC</label>
                            <input readonly  type="text" class="form-control float-center" rows="3" placeholder="Enter ..." value="{{$tlactions[0]['feedback_from_qc'] }}">
                          </div>

                          <form  action="{{ route('qaresults.update') }}"  method="POST">
                            @csrf
                            @if ($supervisorlogged && $supervisorlogged->id === 5)

                            <div class="col">
                                <label>Feedback From Supervisor</label>
                                <input type="text" name="supervisor_comment"  class="form-control float-center" rows="3" placeholder="Enter ...">
                                <input type="hidden" name="id" value="{{$tlactions[0]['id']}}">
                              </div>

                            @elseif($agentlogged && $agentlogged->id === 4 && !empty($tlactions[0]['supervisor_comment']))
                            <div class="col">
                                <label>Feedback From Supervisor</label>
                                <input readonly  type="text" class="form-control float-center" rows="3" placeholder="Enter ..." value="{{$tlactions[0]['supervisor_comment'] }}">
                              </div>
                              <div class="col">
                                <label>Feedback From Agent</label>
                                <input type="text" name="agent_comment" class="form-control float-center" rows="3" placeholder="Enter ..."value="">
                                <input type="hidden" name="id" value="{{$tlactions[0]['id']}}">
                      </div>

                            @endif


                  <!-- /.card-body -->
                  <div class="card-footer">
                  <!--  <button type="submit" class="btn btn-success float-right">Save & Finish</button> -->
                  @if ($tlactions[0]['id'] == $autofail[0]['results_id'])

                  <a href="{{ route('autofail.edit',$tlactions[0]['id']) }}" class="btn btn-danger float-left"  > Update Alert Form</a>

                  @else
                  <a style="display:none;" href="{{ route('autofail.edit',$tlactions[0]['id']) }}" class="btn btn-danger float-left"   > Update Alert Form</a>

                  @endif


                  <button type="submit" class="btn btn-success float-right">Submit</button>
                </form>
                  </div>


  </div>





@stop

@section('css')

@stop

@section('js')
{{-- <script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script> --}}
@stop
