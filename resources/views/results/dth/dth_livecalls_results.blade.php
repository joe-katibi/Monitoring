@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
  <!-- /.card -->

  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">DTH Live Results</h3>
    </div>

      <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <div class="col-md-2">
        <label>Account number</label>
      <input readonly type="number" name="account_number" class="form-control" placeholder="account_number" value="{{$dthlivecalls[0]['account_number']}}">
    </div>
        <div class="col-md-2">
            <label>Date</label>
          <input readonly type="date" name="date" class="form-control" placeholder="date" value="{{$dthlivecalls[0]['date '] }}">
        </div>
        <div class="col-2">
            <label>Category</label>
            <input readonly type="text" name="category" class="form-control" placeholder="category" value="{{$dthlivecalls[0]['category_name '] }}">
        </div>
        <div class="col-2">
            <label>Supervisor</label>
            <input readonly type="text" name="supervisor" class="form-control" placeholder="supervisor" value="{{ $dthlivecalls[0]['supervisor']}}">
        </div>
        <div class="col-2">
          <label>Agent</label>
          <input readonly type="text" name="agent" class="form-control" placeholder="supervisor" value="{{ $dthlivecalls[0]['agent']}}">
        </div>
        <div class="col-md-2">
          <label>Quality Analysts</label>
          <input readonly type="text" class="form-control" name="quality_analysts"
          placeholder="Quality Analysts" value="{{ $dthlivecalls[0]['quality_analysts']}}">
      </div>
    </div>
 </div>

 <div class="card-body">
    <div class="row">
        <div class="col">
             <label for="">Issue Summary</label>
             <input readonly type="text" name="issue_summary" class="form-control" placeholder="issue_summary" value="{{$dthlivecalls[0]['issue_summary'] }}">
             </div>
             <div class="col">
                <label for="">Strength Summary</label>
                <div class="form-control" style="height: auto; overflow-y: scroll;">
                 @foreach ($strengthResults as $strength) <span class="badge badge-success">{{ $strength->summary_name }}</span>
                 @endforeach
                 </div>
                </div>
        </div>
</div>
<div class="card-body">
        <div class="row">
            <div class="col-6">
            <label for="">Issue Description:</label>
            <input readonly name="issue_description" class="form-control float-center" rows="4" value="{{ $dthlivecalls[0]['issue_description'] }}" >
            </div>
        <div class="col-6">
             <label for="">Strength Description:</label>
             <input readonly name="strength_description" class="form-control float-center" rows="4" value="{{ $dthlivecalls[0]['strength_description']}}" >
            </div>
        </div>
    </div>
<div class="card-body">
   <div class="row">
    <div class="col">
        <label for="">Gaps Identifted Summary</label>
        <div class="form-control" style="height: auto; overflow-y: scroll;">
            @foreach ($gapResults as $gap) <span class="badge badge-danger">{{ $gap->gap_name }}</span>
            @endforeach
            </div>
       </div>
        <div class="col-sm-6">
                <label for="">Voice of Customer Summary</label>
               <input readonly class="form-control" id="voc_summary" name="voc_summary"  value="{{ $dthlivecalls[0]['voc_summary'] }}">

             </div>
        </div>
 </div>
<div class="card-body">
         <div class="row">
            <div class="col-6">
            <label for=""> Gaps identified Description:</label>
            <input readonly  name="gaps_description" class="form-control float-center" rows="3"  value="{{ $dthlivecalls[0]['gaps_description']}}" >
          </div>
        <div class="col-6">
            <label for="">VOC Description:</label>
            <input readonly name="voc_description" class="form-control float-center" rows="3"  value="{{ $dthlivecalls[0]['voc_description'] }}" >
         </div>
      </div>
    </div>
 <div class="card-footer">
  {{-- <a href="{{ route('dthlivecalls.edit',$dthlivecalls[0]['id'] ) }}" class="btn btn-info float-left"  > Edit Live Call</a> --}}
  <a href="{{ route('category') }}" class="btn btn-info float-right"  > QA Another Call</a>

     </div>

  </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
