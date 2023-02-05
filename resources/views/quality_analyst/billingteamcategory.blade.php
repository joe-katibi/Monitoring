@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
    <!-- /.card -->

    <form action="{{ route('billing.store') }}" method="POST" name="listForm">
      <input type="hidden"  name="date_updated" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
        @csrf
        <div class="card card-success">
            <div class="card-header">
                <input readonly class="form-control" style="color: green" name="category" value="{{ $tittle->category_name }}" >
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label>Supervisor</label>
                        <input readonly type="text" class="form-control" name="supervisor" placeholder="supervisor"
                            value="{{ $supervisor->name }}">
                    </div>
                    <div class="col-2">
                        <label>Agent name</label>
                        <select class="custom-select" id="final" name="agent_name" aria-placeholder="select an option">
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
                    <div class="col-2">
                        <label>Quality Analysts</label>
                        <input readonly type="text" class="form-control" name="quality_analysts"
                            placeholder="Quality Analysts" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-2">
                        <label>Date</label>
                        <input readonly name="date_recorded" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                    </div>
                    <div class="col-2">
                        <label>Customer Account</label>
                        <input type="number" name="customer_account"class="form-control" placeholder="Account">
                    </div>
                    <div class="col-2">
                        <label>Recording ID</label>
                        <input type="number" name="recording_id" class="form-control" placeholder="record">
                    </div>
                </div>

            </div>
            <div class="card-body">
              <table class="table table-bordered" id="questionsTable">
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
                              <td>{{ $row->number }}</td>
                              <td>{{ $row->question }}</td>
                              <td>{{ $row->yes }}</td>
                              <td>
                                <input type="radio"  id="questions" name="question_no_[{{ $row->number }}]" value="{{ $row->yes }}"  > Yes </label>
                                <input type="radio" id="questions" name="question_no_[{{ $row->number }}]" value="{{ $row->no }}"  > No </label>
                              </td>
                          </tr>
                      @endforeach

                  </tbody>
              </table>
          </div>
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Call Tracker</h3>
                    </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <label>QA-Call Category</label>
                                <select class="custom-select" id="qa_call_category" name="qa_call_category"
                                    value="qa_call_category" aria-placeholder="select an option">
                                    <option disabled selected>select an option</option>
                                    @foreach ($crm as $row)
                                    <option value="{{$row['call_tracker']}}">{{$row['call_tracker']}}</option>
                                    <span style="color:red">
                                        @error('select an option')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-2">
                                <label>QA-Call Nature</label>
                                <select class="custom-select" id="qa_call_nature" name="qa_call_nature"
                                    value="qa_call_nature"a ria-placeholder="select an option">
                                    <option disabled selected>select an option</option>
                                    @foreach($subcrm as $sub_cat)
                                    <option value="{{$sub_cat->sub_call_tracker}}">{{$sub_cat->sub_call_tracker}}</option>
                                    <span style="color:red">
                                        @error('select an option')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label>Agent-Call Category</label>
                                <select class="custom-select" id="qa_call_category" name="qa_call_category"
                                value="qa_call_category" aria-placeholder="select an option">
                                <option disabled selected>select an option</option>
                                @foreach ($crm as $row)
                                <option value="{{$row['call_tracker']}}">{{$row['call_tracker']}}</option>
                                <span style="color:red">
                                    @error('select an option')
                                        {{ $message }}
                                    @enderror
                                </span>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-2">
                                <label>Agent-Call Nature</label>
                                <select class="custom-select" id="qa_call_nature" name="qa_call_nature"
                                value="qa_call_nature"a ria-placeholder="select an option">
                                <option disabled selected>select an option</option>
                                @foreach($subcrm as $sub_cat)
                                <option value="{{$sub_cat->sub_call_tracker}}">{{$sub_cat->sub_call_tracker}}</option>
                                <span style="color:red">
                                    @error('select an option')
                                        {{ $message }}
                                    @enderror
                                </span>
                                @endforeach

                            </select>
                            </div>
                            <div class="col-2">
                                <label>General Issue</label>
                                <select class="custom-select" id="qa_call_nature" name="qa_call_nature"
                                value="qa_call_nature"a ria-placeholder="select an option">
                                <option disabled selected>select an option</option>
                                @foreach($general_issue as $row)
                                <option value="{{$row['name']}}">{{$row['name']}}</option>
                                <span style="color:red">
                                    @error('select an option')
                                        {{ $message }}
                                    @enderror
                                </span>
                                @endforeach
                            </select>

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
                    <div class="container">
                    <div class="col">
                        <label>Feedback From QC</label>
                        <textarea class="form-control float-center" rows="3" name="feedback_from_qc" value="feedback_from_qc"
                            placeholder="Enter ..."></textarea>
                    </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button onclick="add()" type="submit" class="btn btn-success float-right" id="submit">Save &
                        Finish</button>
                    {{-- <a href="/results/billing/billing_results" class="btn btn-success float-left"  > to Results</a> --}}

                </div>
        </div>


@include('sweetalert::alert')

    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

      questionsTable = $('#questionsTable').dataTable({

        "dom" : 'lfrtip'
      });

      add(){
        Toast.fire({
            icon:'success',
            title: 'Your Audit has been saved'
        })
      }

    </script>



@stop
