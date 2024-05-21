@extends('adminlte::page')

@section('title', 'DTh Results | Zuku Monitoring')

@section('content_header')
@stop

@section('content')
@include('sweetalert::alert')
  <div class="card card-info">
    <div class="card-header">
      {{-- <input readonly class="form-control" style="color: rgb(0, 128, 255)" name="category" value="{{ $tittle->category_name }}"> --}}
      <input readonly class="form-control" style="color: rgb(0, 128, 255)" name="category" value="DTH billing Results">
    </div>

      <div class="card-body">
         <div class="row">
        <div class="col-2">
            <label>Supervisor</label>
          <input readonly type="text" class="form-control" placeholder="supervisor" value="{{ $question_v[0]['SupervisorName']  }}">
        </div>

        <div class="col-2">
            <label>Agent name</label>
          <input readonly type="text" class="form-control" placeholder="agent name" value="{{ $question_v[0]['agentName']  }}">
        </div>
        <div class="col-2">
            <label>QA name</label>
          <input readonly type="text" class="form-control" placeholder="qc name" value="{{ $question_v[0]['qualityName'] }}">
        </div>
        <div class="col-2">
            <label>Date</label>
          <input readonly value="<?php echo date("d-m-Y H:i:s");?>" class="form-control" value="{{ $question_v[0]['date_recorded'] }}" >
        </div>
        <div class="col-2">
            <label>Customer Account</label>
          <input readonly type="text" class="form-control" placeholder="Account" value="{{ $question_v[0]['customer_account']  }}">
        </div>
        <div class="col-2">
            <label>Recording ID</label>
          <input readonly type="text" class="form-control" placeholder="record" value="{{ $question_v[0]['recording_id'] }}" >
        </div>
        <div class="col-2">
          <label>Total Marks</label>
        <input readonly type="text" class="form-control" placeholder="archived" value="{{ $question_v[0]['final_results'] }}%">
      </div>
      </div>

      <div class="card-body">
      <table class="table table-bordered" id="questionsTable">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Question</th>
            <th>Achieved</th>
          </tr>
        </thead>
        <tbody>

          @foreach($question_v as $row )
          <tr>
            <td>{{ $row->number }}</td>
             <td>{{ $row->question }}</td>
                <td>{{$row->marks}}</td>

          </tr>
          @endforeach

        </tbody>
       </table>
      </div>
     </div>
                  <div class="card-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Feedback From QC</label>
                            <input readonly class="form-control float-center" rows="3" value="{{ $question_v[0]['feedback_from_qc'] }}">
                          </div>
                  </div>
                  <div class="card-footer">
                  <a href="{{ route('dthbilling.edit',$question_v[0]['id']) }}" class="btn btn-info float-left"  > Edit Call</a>
                    <a href="{{route('category') }}" class="btn btn-info float-right"  > QA Another Call</a>
                  </div>
                  <!-- /.card-footer -->

              </div>
              <!-- /.card -->
  </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>

        questionsTable = $('#questionsTable').dataTable({

          "dom" : 'lfrtip'
        });

      </script>
@stop
