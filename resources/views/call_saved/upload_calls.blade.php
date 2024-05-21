@extends('adminlte::page')

@section('title', 'Calls-Saved | Zuku Monitoring')

@section('content_header')
    <h1 hidden>Uploaad</h1>
@stop

@section('content')
@include('sweetalert::alert')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green"  value="Upload Best or Worst Call of the month">

    </div>
    <div class="card-body">
<form  action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
    <input  type="hidden" class="form-control" name="qa_name" value="{{ Auth::user()->id }}">
    @csrf
    <div class="row">

        <div class="col-md-2">
            <label for="section">Select service</label>
            <div class="form-group">
               <select class="form-control" required="required" id="service" name="service">
                <option selected="selected" value="">--Select service--</option>
                @foreach ($services as $service)
                <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                @endforeach
            </select>
            </div>
            </div>
            <div class="col-md-2">
                <label for="service[]">Select Category</label>
                <div class="form-group">
                    <select class="form-control" required="required" id="category" name="category">
                        <option  value="">--Select Category--</option>
                    </select>
                </div>
            </div>
                <div class="col-md-2">
                    <label>Supervisor</label>
                    <select class="custom-select"id="supervisor" name="supervisor" data-placeholder="select" value="{{ old('supervisor') }}">
                      <option  value="">--Select Supervisor--</option>
                    </select>
                    <span style="color:red">@error('supervisor'){{ $message }}@enderror</span>
                </div>
                <div class="col-md-2">
                  <label>Agent</label>
                  <select class="custom-select"id="agent" name="agent" data-placeholder="select" value="{{ old('agent') }}">
                      <option  value="">--Select Agent--</option>
                 </select>
                 <span style="color:red">@error('agent'){{ $message }}@enderror</span>
                </div>
        <div class="col-2">
            <label>Call Rating</label>
            <select class="custom-select"id="call_rating" required="required" name="call_rating" data-placeholder="select">
                <option disabled>Select option</option>
            @foreach ($callrating as $callratings)
            <option value="{{$callratings['id']}}">{{$callratings['rating_name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-2">
            <label>Date</label>
                <input type="date" name="call_date" required="required" class="form-control" placeholder="call_date">
        </div>
      </div>
      <hr>
      @can('view-upload-call-button')
        <div class="card-body">
          <div id="actions" class="row-4">
            <div class="container">
            <div class="col">
              <div class="btn-group w-100">
                <span input class="btn btn-success col start">
                    <input type="file" name="call_file"  required="required">
                </span>
                <button type="submit" class="btn btn-primary col start">
                  <i class="fas fa-upload"></i>
                  <span>Start upload</span>
                </button>

                {{-- TO DO on Cancel --}}
                <button type="reset" class="btn btn-warning col cancel">
                  <i class="fas fa-times-circle"></i>
                  <span>Cancel upload</span>
                </button>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
              <div class="fileupload-process w-100">
                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                  <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        @endcan
</form>
</div>
<div class="card-body">
    <table class="table table-bordered" id="questionsTable">
        <thead>
            <tr>
                <th>Agent</th>
                <th>Supervisor </th>
                <th>Quality Analyts</th>
                <th>Category</th>
                <th>Service</th>
                <th>Country</th>
                <th>Rating</th>
                <th>Date</th>
                <th style="width: 5%">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($upload as $uploads)
            <tr style="height: 2%">
                <td>{{$uploads['agentName']  }}</td>
                <td>{{ $uploads['SupervisorName'] }}</td>
                <td>{{ $uploads['qualityName'] }}</td>
                <td>{{ $uploads['category_name'] }}</td>
                <td>
                    @if ($uploads->service_id == '1')
                    <a disable class="badge badge-success" >Cable</a>
                    @else
                    <a disable class="badge badge-primary" >DTH</a>
                    @endif
                </td>
                <td>{{$uploads['country_name'] }}</td>
                <td>
                    @if ($uploads->rating_name == 'Best')
                    <a disable class="badge badge-success" >Best</a>
                    @else
                    <a disable class="badge badge-danger" >Worst</a>
                    @endif
                </td>
                <td>{{$uploads['call_date'] }}</td>
                <th >
                    <audio controls class="badge badge-success" >
                        <source src="/assets/{{ $uploads['call_file']  }}" type="audio/mp3">
                      Your browser does not support the audio element.
                      </audio>
                </th>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="/plugins/dropzone/min/dropzone.min.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script>
  <script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Service Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#service').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#category").html('');
            $.ajax({
                url: '/auto-fail/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#category').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#category").append('<option value="' + value
                            .id + '">' + value.category_name + '</option>');
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
        Supervisor Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#supervisor").html('');
            $.ajax({
                url: '/categorylivesupervisor/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#supervisor').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#supervisor").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
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
        Agent drop down Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#agent").html('');
            $.ajax({
                url: '/categoryliveagent/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#agent').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#agent").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>
@stop
