@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
  <div class="card card-info">
    <div class="card-header">
      {{-- <input readonly class="form-control" style="color: rgb(0, 128, 255)" name="category" value="{{ $tittle->category_name }}"> --}}
      <input readonly class="form-control" style="color: rgb(0, 128, 255)" name="category" value="DTH billing Results">
    </div>

      <div class="card-body">
         <div class="row">
        <div class="col-2">
            <label>Supervisor</label>
          <input readonly type="text" class="form-control" placeholder="supervisor" value="{{ $results_details[0]->supervisor }}">
        </div>

        <div class="col-2">
            <label>Agent name</label>
          <input readonly type="text" class="form-control" placeholder="agent name" value="{{ $results_details[0]->agent_name }}">
        </div>
        <div class="col-2">
            <label>QA name</label>
          <input readonly type="text" class="form-control" placeholder="qc name" value="{{ $results_details[0]->quality_analysts }}">
        </div>
        <div class="col-2">
            <label>Date</label>
          <input readonly value="<?php echo date("d-m-Y H:i:s");?>" class="form-control" value="{{ $results_details[0]->date_recorded }}" >
        </div>
        <div class="col-2">
            <label>Customer Account</label>
          <input readonly type="text" class="form-control" placeholder="Account" value="{{ $results_details[0]->customer_account }}">
        </div>
        <div class="col-2">
            <label>Recording ID</label>
          <input readonly type="text" class="form-control" placeholder="record" value="{{ $results_details[0]->recording_id }}" >
        </div>
        <div class="col-2">
          <label>Total Marks</label>
        <input readonly type="text" class="form-control" placeholder="archived" value="{{ $results_details[0]->results }}%">
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

          @foreach($results_marks as $row )
          <tr>
            <td>{{ $row->question_no }}</td>
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
                            <textarea readonly class="form-control float-center" rows="3" placeholder="Enter ..."></textarea>
                          </div>
                  </div>
                  <div class="card-footer">
                  <a href="#" class="btn btn-success float-left"  > Edit Call</a>
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