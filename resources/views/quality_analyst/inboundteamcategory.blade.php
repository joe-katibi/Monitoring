@extends('adminlte::page')

@section('title', 'inbound')

@section('content_header')
@stop

@section('content')
  <!-- /.card -->
  <form action="{{ route('inbound.store') }}" method="POST" name="listForm">
    <input type="hidden"  name="date_updated" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
      @csrf
  <div class="card card-success">
    <div class="card-header">
      <textarea readonly class="form-control" style="color: green" name="{{ $tittle->category_name }}" value="{{ $tittle->id}}">
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-2">
            <label>Supervisor</label>

            <input type="text" class="form-control" name="supervisor" placeholder="supervisor" value="{{$supervisor->name}}">

          </div>
        <div class="col-2">
            <label>Agent name</label>
            <select class="custom-select" id="final" name="agent_name" aria-placeholder="select an option">
              <option readonly aria-placeholder="select an option">Select Agent</option>
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
        <div class="col-2">
          <label>Quality Analysts</label>
        <input type="text" class="form-control" name="quality_analysts" placeholder="Quality Analysts" value="{{ Auth::user()->name }}">
      </div>
        <div class="col-2">
            <label>Date</label>
          <input readonly value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control"  >
        </div>
        <div class="col-2">
            <label>Customer Account</label>
          <input type="number" class="form-control" placeholder="Account" name="customer_account">
        </div>
        <div class="col-2">
            <label>Recording ID</label>
          <input type="number" class="form-control" placeholder="record" name="recording_id">
        </div>
      </div>

      <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Question</th>
            <th>Marks</th>
            <th style="width: 10%">Select rating</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($questions as $row)
          <tr>
            <td>{{$row->number}}</td>
              <td>{{$row->question}}</td>
              <td>{{$row->yes}}</td>
              <td>
                <input type="radio"  id="questions" name="question_no_[{{ $row->number }}]" value="{{ $row->yes }}"  > Yes </label>
                <input type="radio" id="questions" name="question_no_[{{ $row->number }}]" value="{{ $row->no }}"  > No </label>

              </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.card-body -->

    <div>

      <!-- /.card-header -->
      <div class="card-body">
          <div class="card-header">
              <h3 class="card-title">Call Tracker</h3>
          </div>
          <div>
              <div class="row">
                  <div class="col-2">
                      <label>QA-Call Category</label>
                      {{-- @foreach ($billingagent as $agent) --}}
                      <select class="custom-select" id="qa_call_category" name="qa_call_category"
                          value="qa_call_category" aria-placeholder="select an option">
                          <option aria-placeholder="select an option">QA Call Category</option>
                          {{-- <option value="{{$agent->name}}">{{$agent->name}}</option> --}}
                          <span style="color:red">
                              @error('select an option')
                                  {{ $message }}
                              @enderror
                          </span>
                      </select>
                      {{-- @endforeach --}}
                  </div>
                  <div class="col-2">
                      <label>QA-Call Nature</label>
                      {{-- @foreach ($billingagent as $agent) --}}
                      <select class="custom-select" id="qa_call_nature" name="qa_call_nature"
                          value="qa_call_nature"a ria-placeholder="select an option">
                          <option aria-placeholder="select an option">QA Call Nature</option>
                          {{-- <option value="{{$agent->name}}">{{$agent->name}}</option> --}}
                          <span style="color:red">
                              @error('select an option')
                                  {{ $message }}
                              @enderror
                          </span>
                      </select>
                      {{-- @endforeach --}}
                  </div>
                  <div class="col-2">
                      <label>Agent-Call Category</label>
                      {{-- @foreach ($billingagent as $agent) --}}
                      <select class="custom-select" id="agent_call_category" name="agent_call_category"
                          value="agent_call_category" aria-placeholder="select an option">
                          <option aria-placeholder="select an option">Agent Call Category</option>
                          {{-- <option value="{{$agent->name}}">{{$agent->name}}</option> --}}
                          <span style="color:red">
                              @error('select an option')
                                  {{ $message }}
                              @enderror
                          </span>
                      </select>
                      {{-- @endforeach --}}
                  </div>
                  <div class="col-2">
                      <label>Agent-Call Nature</label>
                      {{-- @foreach ($billingagent as $agent) --}}
                      <select class="custom-select" id="agent_call_nature" name="agent_call_nature"
                          value="agent_call_nature" aria-placeholder="select an option">
                          <option aria-placeholder="select an option">Agent Call Nature</option>
                          {{-- <option value="{{$agent->name}}">{{$agent->name}}</option> --}}
                          <span style="color:red">
                              @error('select an option')
                                  {{ $message }}
                              @enderror
                          </span>
                      </select>
                      {{-- @endforeach --}}
                  </div>
                  <div class="col-2">
                      <label>General Issue</label>
                      {{-- @foreach ($billingagent as $agent) --}}
                      <select class="custom-select" id="general_issue" name="general_issue" value="general_issue"
                          aria-placeholder="select an option">
                          <option aria-placeholder="select an option">Issue Highlighted general</option>
                          {{-- <option value="{{$agent->name}}">{{$agent->name}}</option> --}}
                          <span style="color:red">
                              @error('select an option')
                                  {{ $message }}
                              @enderror
                          </span>
                      </select>
                      {{-- @endforeach --}}
                  </div>
                  <div class="col-2">
                      <label>Specific Issue</label>
                      {{-- @foreach ($billingagent as $agent) --}}
                      <select class="custom-select" id="specific_issue" name="specific_issue"
                          value="specific_issue" aria-placeholder="select an option">
                          <option aria-placeholder="select an option">Issue Highlighted specific</option>
                          {{-- <option value="{{$agent->name}}">{{$agent->name}}</option> --}}
                          <span style="color:red">
                              @error('select an option')
                                  {{ $message }}
                              @enderror
                          </span>
                      </select>
                      {{-- @endforeach --}}
                  </div>
              </div>
          </div>

          <div class="col-10">
              <label>Feedback From QC</label>
              <textarea class="form-control float-center" rows="3" name="feedback_from_qc" value="feedback_from_qc"
                  placeholder="Enter ..."></textarea>
          </div>
      </div>
      <div class="card-footer">
          <button  type="submit" class="btn btn-success float-right" id="submit">Save &
              Finish</button>

      </div>
  </div>
</div>
</div>
</div>
<!-- /.card -->
</form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
