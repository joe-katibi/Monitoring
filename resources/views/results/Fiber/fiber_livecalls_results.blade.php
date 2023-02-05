@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
    <div class="card card-success">
       <div class="card-header">
         <input readonly class="form-control" style="color: green" name="category" value="Fiber Live Calls Results">
        </div>
  <!-- /.card-header -->
  <div class="card-body">
      <div class="row">
        <div class="col-md-2">
          <label>Account number</label>
        <input readonly type="number" name="account_number" class="form-control" placeholder="account_number" value="{{$fiberlivecalls->account_number }}">
      </div>
          <div class="col-md-2">
              <label>Date</label>
            <input readonly type="date" name="date" class="form-control" placeholder="date" value="{{$fiberlivecalls->date  }}">
          </div>
          <div class="col-2">
              <label>Category</label>
              <input readonly type="text" name="category" class="form-control" placeholder="category" value="{{$fiberlivecalls->category_name  }}">
          </div>
          <div class="col-2">
              <label>Supervisor</label>
              <input readonly type="text" name="supervisor" class="form-control" placeholder="supervisor" value="{{ $fiberlivecalls->supervisor}}">
          </div>
          <div class="col-2">
            <label>Agent</label>
            <input readonly type="text" name="agent" class="form-control" placeholder="supervisor" value="{{ $fiberlivecalls->agent}}">
          </div>
          <div class="col-md-2">
            <label>Quality Analysts</label>
            <input readonly type="text" class="form-control" name="quality_analysts"
            placeholder="Quality Analysts" value="{{ $fiberlivecalls->quality_analysts}}">
        </div>
      </div>
   </div>
      <div class="card-body">
          <div class="row">
              <div class="col-sm-6">
                   <label for="">Issue Summary</label>
                   <input readonly type="text" name="issue_summary" class="form-control" placeholder="issue_summary" value="{{$fiberlivecalls->issue_summary }}">
                   </div>
              <div class="col-sm-6">
                   <label for="">Strength Summary</label>
                   <input readonly type="text" class="form-control" id="strength_summary" name="strength_summary"  value="{{ $fiberlivecalls->summary_name}}">
                   </div>
              </div>
      </div>
      <div class="card-body">
              <div class="row">
                  <div class="col-6">
                  <label for="">Issue Description:</label>
                  <input readonly name="issue_description" class="form-control float-center" rows="4" value="{{ $fiberlivecalls->issue_description }}" >
                  </div>
              <div class="col-6">
                   <label for="">Strength Description:</label>
                   <input readonly name="strength_description" class="form-control float-center" rows="4" value="{{ $fiberlivecalls->strength_description}}" >
                  </div>
              </div>
          </div>
  <div class="card-body">
         <div class="row">
                  <div class="col-sm-6">
                    <label for="">Gaps Identifted Summary</label>
                    <input readonly class="form-control" id="gaps_summary" name="gaps_summary"  value="{{ $fiberlivecalls->gap_name }}">

                   </div>
              <div class="col-sm-6">
                      <label for="">Voice of Customer Summary</label>
                     <input readonly class="form-control" id="voc_summary" name="voc_summary"  value="{{ $fiberlivecalls->voc_summary }}">

                   </div>
              </div>
       </div>
      <div class="card-body">
               <div class="row">
                  <div class="col-6">
                  <label for=""> Gaps identified Description:</label>
                  <input readonly  name="gaps_description" class="form-control float-center" rows="3"  value="{{ $fiberlivecalls->gaps_description}}" >
                </div>
              <div class="col-6">
                  <label for="">VOC Description:</label>
                  <input readonly name="voc_description" class="form-control float-center" rows="3"  value="{{ $fiberlivecalls->voc_description }}" >
               </div>
            </div>
          </div>
       <div class="card-footer">

           </div>
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
