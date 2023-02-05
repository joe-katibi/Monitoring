@extends('adminlte::page')

@section('title', 'Dth digital')

@section('content_header')
@stop

@section('content')
  <!-- /.card -->
  <form action="{{ route('dthlivecalls.store') }}" method="POST" name="listForm">
    {{csrf_field()}}
        <div class="card card-info">
           <div class="card-header">
            <input readonly class="form-control" style="color: rgb(0, 128, 255)" name="category" value="{{ $tittle->category_name }}">
        </div>
      <!-- /.card-header -->
      <div class="card-body">
          <div class="row">
            <div class="col-md-2">
                <label>Account</label>
              <input type="number" name="account_number" class="form-control" placeholder="account_number" value="{{ old('account_number') }}">
            </div>
              <div class="col-md-2">
                  <label>Date</label>
                  <input readonly name="date" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
              </div>
              <div class="col-md-2">
                  <label>Category</label>
                  <select class="custom-select"id="category" name="category" data-placeholder="select" value="{{ old('category') }}">
                    <option disabled selected>Select a Category</option>
                    @foreach ($cat as $cats)
                    <option value="{{ $cats['id'] }}">{{$cats['category_name']}}</option>
                   @endforeach
                  </select>
              </div>
              <div class="col-md-3">
                  <label>Supervisor</label>
                  <select class="custom-select"id="supervisor" name="supervisor" data-placeholder="select" value="{{ old('supervisor') }}">
                   {{-- @foreach ($supervisor as $supervisors) --}}
                   <option value="{{ $supervisor->name }}">{{ $supervisor->name }}</option>
                   <span style="color:red">
                       @error('select an option')
                           {{ $message }}
                       @enderror
                   </span>
               {{-- @endforeach --}}
                  </select>
              </div>
              <div class="col-md-3">
                <label>Agent</label>
                <select class="custom-select"id="agent" name="agent" data-placeholder="select" value="{{ old('agent') }}">
                    <option disabled selected>Select Agent</option>
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->name }}">{{ $agent->name }}</option>
                        <span style="color:red">
                            @error('select an option')
                                {{ $message }}
                            @enderror
                        </span>
                    @endforeach
               </select>
              </div>
          </div>
       </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-6">
                       <label for="">Issue Summary</label>
                       <select class="custom-select"id="issue_summary" name="issue_summary" data-placeholder="select" value="{{ old('issue_summary') }}">
                        <option disabled selected>Select an issue</option>
                        @foreach ($crm as $crms)
                        <option value="{{$crms['call_tracker']}}">{{$crms['call_tracker']}}</option>
                        @endforeach
                       </select>
                       <span style="color:red">@error('issue_summary'){{ $message }}@enderror</span>
                       </div>
                  <div class="col-sm-6">
                       <label for="">Strength Summary</label>
                       <select class="custom-select" id="strength_summary" name="strength_summary" data-placeholder="select" value="{{ old('strength_summary') }}">
                        @foreach ($sumry as $key=>$item)
                       <option value="{{$item['summary_name']}}">{{$item['summary_name']}}</option>
                        @endforeach
                    </select>
                       <span style="color:red">@error('issue_summary'){{ $message }}@enderror</span>
                       </div>
                  </div>
          </div>
          <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                      <label for="">Issue Description:</label>
                      <textarea  name="issue_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('issue_description') }}" ></textarea>
                      <span style="color:red">@error('issue_description'){{ $message }}@enderror</span>
                      </div>
                  <div class="col-6">
                       <label for="">Strength Description:</label>
                       <textarea  name="strength_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('strength_description') }}" ></textarea>
                       <span style="color:red">@error('strength_description'){{ $message }}@enderror</span>
                      </div>
                  </div>
              </div>
      <div class="card-body">
             <div class="row">
                      <div class="col-sm-6">
                        <label for="">Gaps Identifted Summary</label>
                        <select class="custom-select"id="gaps_summary" name="gaps_summary" data-placeholder="select" value="{{ old('gaps_summary') }}">
                            @foreach ($sumgap as $key=>$item)
                            <option value="{{$item['id']}}">{{$item['gap_name']}}</option>>
                        @endforeach
                       </select>
                        <span style="color:red">@error('gaps_summary'){{ $message }}@enderror</span>
                       </div>
                  <div class="col-sm-6">
                          <label for="">Voice of Customer Summary</label>
                          <select class="custom-select"id="voc_summary" name="voc_summary" data-placeholder="select" value="{{ old('voc_summary') }}">
                            <option disabled selected> Select VOC</option>
                            @foreach ($sumvoc as $row)
                          <option value="{{$row->summary_name}}">{{$row->summary_name}}</option>
                          @endforeach
                          </select>
                         <span style="color:red">@error('voc_summary'){{ $message }}@enderror</span>
                       </div>
                  </div>
           </div>
          <div class="card-body">
                   <div class="row">
                      <div class="col-6">
                      <label for=""> Gaps identified Description:</label>
                      <textarea  name="gaps_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('gaps_description') }}" ></textarea>
                      <span style="color:red">@error('gaps_description'){{ $message }}@enderror</span>
                    </div>
                  <div class="col-6">
                      <label for="">VOC Description:</label>
                      <textarea  name="voc_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('voc_description') }}" ></textarea>
                     <span style="color:red">@error('voc_description'){{ $message }}@enderror</span>
                   </div>
                </div>
              </div>
           <div class="card-footer">
              <button type="submit" class="btn btn-success float-right">Submit</button>
               </div>
      </div>
  </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('strength_summary')  // id
</script>
<script>
    new MultiSelectTag('gaps_summary')  // id
</script>
@stop
