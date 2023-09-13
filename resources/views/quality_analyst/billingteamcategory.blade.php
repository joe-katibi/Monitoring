@extends('adminlte::page')

@section('title', 'Cable-Category')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
    <!-- /.card -->
    <form action="{{ route('billing.store') }}" method="POST" name="listForm">
      <input type="hidden"  name="date_updated" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
        @csrf
        <div class="card card-success">
            <div class="card-header">
                <input readonly class="form-control" style="color: green"  value="{{ $tittle->category_name }}">
                <input hidden readonly class="form-control" style="color: green" name="category" value="{{ $tittle->id }}">
                <input type="hidden" name="reporttype" value="{{ $reporttype['type_id']}}">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label>Supervisor</label>
                        <select class="custom-select" required id="final" name="supervisor" aria-placeholder="select an option">
                            <option disabled selected>Select Agent</option>
                            @foreach ($supervisor as $supervisors)
                                <option value="{{ $supervisors->id }}">{{ $supervisors->name }}</option>
                                <span style="color:red">  @error('select an option')   {{ $message }}    @enderror </span>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <label>Agent name</label>
                        <select class="custom-select" required id="final" name="agent_name" aria-placeholder="select an option">
                            <option disabled selected>Select Agent</option>
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
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
                        <input readonly type="text" class="form-control" value="{{ Auth::user()->name }}">
                        <input  type="hidden" class="form-control" name="quality_analysts" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="col-2">
                        <label>Date</label>
                        <input readonly name="date_recorded" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                        <span style="color:red">@error('date_recorded'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-2">
                        <label>Customer Account</label>
                        <input type="number" required name="customer_account"class="form-control" placeholder="Account">
                        <span style="color:red">@error('customer_account'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-2">
                        <label>Recording ID</label>
                        <input type="number" required name="recording_id" class="form-control" placeholder="record">
                        <span style="color:red">@error('recording_id'){{ $message }}@enderror</span>
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
                                <input type="radio" required  id="questions" name="question_no_[{{ $row->id }}]" value="{{ $row->yes }}"  > Yes </label>
                                <input type="radio" required id="questions" name="question_no_[{{ $row->id }}]" value="{{ $row->no }}"  > No </label>
                                <span style="color:red">@error('question_no_'){{ $message }}@enderror</span>

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
                                    <option value="{{$row['id']}}">{{$row['call_tracker']}}</option>
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
                                    value="qa_call_nature"aria-placeholder="select an option">
                                </select>
                            </div>
                            <div class="col-2">
                                <label>Agent-Call Category</label>
                                <select class="custom-select" id="agent_call_category" name="agent_call_category"
                                value="agent_call_category" aria-placeholder="select an option">
                                <option disabled selected>select an option</option>
                                @foreach ($crm as $row)
                                <option value="{{$row['id']}}">{{$row['call_tracker']}}</option>
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
                                <select class="custom-select" id="agent_call_nature" name="agent_call_nature"
                                value="agent_call_nature"a ria-placeholder="select an option">
                            </select>
                            </div>
                            <div class="col-2">
                                <label>General Issue</label>
                                <select class="custom-select" id="gen_call_nature" name="gen_call_nature"
                                value="gen_call_nature"a ria-placeholder="select an option">
                                <option disabled selected>select an option</option>
                                @foreach($general_issue as $row)
                                <option value="{{$row['id']}}">{{$row['name']}}</option>
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
                                <select class="custom-select" id="specific_issue" name="specific_issue"
                                    value="specific_issue" aria-placeholder="select an option">

                                </select>

                            </div>
                        </div>
                        </div>
                    <div class="container">
                    <div class="col">
                        <label>Feedback From QC</label>
                        <textarea class="form-control float-center" rows="3" name="feedback_from_qc" value="feedback_from_qc"
                            placeholder="Enter ..."></textarea>
                            <span style="color:red">  @error('feedback_from_qc') {{ $message }}  @enderror </span>
                    </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button onclick="add()" type="submit" class="btn btn-success float-right" id="submit">Save &
                        Finish</button>


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

    {{-- <script>

      questionsTable = $('#questionsTable').dataTable({

        "dom" : 'lfrtip'
      });

    </script> --}}

<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Crm Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#qa_call_category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#qa_call_nature").html('');
            $.ajax({
                url: '/calltracker/'+qaa_call_category,
                type: "GET",
                data: {
                    qa_call_category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#qa_call_nature').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#qa_call_nature").append('<option value="' + value
                            .id + '">' + value.sub_call_tracker + '</option>');
                    });

                }
            });
        });

    });
</script>

<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Crm Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#agent_call_category').on('change', function () {
            var qaa_call_category = this.value;
            console.log(qaa_call_category);
            $("#agent_call_nature").html('');
            $.ajax({
                url: '/calltracker/'+qaa_call_category,
                type: "GET",
                data: {
                    agent_call_category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#agent_call_nature').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#agent_call_nature").append('<option value="' + value
                            .id + '">' + value.sub_call_tracker + '</option>');
                    });

                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Crm Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#gen_call_nature').on('change', function () {
            var qaa_call_category = this.value;
            console.log(qaa_call_category);
            $("#specific_issue").html('');
            $.ajax({
                url: '/general-id/'+qaa_call_category,
                type: "GET",
                data: {
                    gen_call_nature: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#specific_issue').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#specific_issue").append('<option value="' + value
                            .id + '">' + value.sub_name + '</option>');
                    });

                }
            });
        });

    });
</script>


@stop
