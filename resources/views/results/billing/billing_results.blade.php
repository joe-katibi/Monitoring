@extends('adminlte::page')

@section('title', 'Billing Results')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
  <!-- /.card -->
  <div class="card card-success">
    <div class="card-header">
      {{-- <input readonly class="form-control" style="color: green" name="category" value="{{ $tittle->category_name }}"> --}}
      <input readonly class="form-control" style="color: green" name="category" value="Results">
      </div>
      <div class="card-body">
         <div class="row">
        <div class="col-2">
            <label>Supervisor</label>
          <input readonly type="text" class="form-control" placeholder="supervisor" value="{{ $question_v[0]['SupervisorName'] }}">
        </div>

        <div class="col-2">
            <label>Agent name</label>
          <input readonly type="text" class="form-control" placeholder="agent name" value="{{ $question_v[0]['agentName'] }}">
        </div>
        <div class="col-2">
            <label>QA name</label>
          <input readonly type="text" class="form-control" placeholder="qc name" value="{{ $question_v[0]['qualityName']}}">
        </div>
        <div class="col-2">
            <label>Date</label>
          <input readonly  class="form-control" value="{{ $question_v[0]['date_recorded'] }}" >
        </div>
        <div class="col-2">
            <label>Customer Account</label>
          <input readonly type="text" class="form-control" placeholder="Account" value="{{ $question_v[0]['customer_account'] }}">
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
      <table class="table table-bordered">
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
                  <a href="{{ route('billing_edit',$question_v[0]['id']) }}" class="btn btn-success float-left"  > Edit Call</a>
                    <a href="{{route('category') }}" class="btn btn-success float-right"  > QA Another Call</a>
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
@stop
