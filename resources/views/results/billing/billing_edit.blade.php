@extends('adminlte::page')

@section('title', 'Billing Results')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('billing_edit',$audit_agent[0]['id']) }}" method="POST">
    @csrf
     @method('PUT')
  <!-- /.card -->
  <div class="card card-success">
    <div class="card-header">
      {{-- <input readonly class="form-control" style="color: green" name="category" value="{{ $tittle->category_name }}"> --}}
      <input readonly class="form-control" style="color: green"  value="Results">
      </div>
      <div class="card-body">
         <div class="row">
        <div class="col-2">
            <label>Supervisor</label>
          <input readonly type="text" class="form-control" placeholder="supervisor" value="{{ $audit_agent[0]['supervisor'] }}">
        </div>

        <div class="col-2">
            <label>Agent name</label>
          <input readonly type="text" class="form-control" placeholder="agent name" value="{{ $audit_agent[0]['agent_name']  }}">
        </div>
        <div class="col-2">
            <label>QA name</label>
          <input readonly type="text" class="form-control" placeholder="qc name" value="{{ $audit_agent[0]['quality_analysts ']}}">
        </div>
        <div class="col-2">
            <label>Date</label>
          <input readonly value="<?php echo date("d-m-Y H:i:s");?>" class="form-control" value="{{ $audit_agent[0]['date_recorded']}}" >
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
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Question</th>
            <th>Achieved</th>
            <th style="width: 10%">Select rating</th>
          </tr>
        </thead>
        <tbody>

          @foreach($audit_agent as $key=> $row )
          <tr>
            <td>{{ $row->question_no }}</td>
             <td>{{ $row->question }}</td>
                <td>{{$row->marks}}</td>
                <td>
                    <input type="radio"  id="questions" name="question_no_[{{ $row->r_id }}]" value="{{ $row->yes }}"  > Yes </label>
                    <input type="radio" id="questions" name="question_no_[{{ $row->r_id }}]" value="{{ $row->no }}"  > No </label>

                  </td>

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
                            <input type="text" class="form-control float-center" rows="3" value="{{ $audit_agent[0]['feedback_from_qc'] }}">
                          </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">edit Audit</button>
                  </div>
                  <!-- /.card-footer -->

              </div>
              <!-- /.card -->
  </div>

</form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
