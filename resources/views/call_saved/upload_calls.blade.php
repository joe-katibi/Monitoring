@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden>Uploaad</h1>
@stop

@section('content')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Upload Best or Worst Call of the month">
    </div>
    <div class="card-body">
<form  action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-2">
            <label>Agent Name</label>
          <select class="custom-select"id="agent_name" name="agent_name" data-placeholder="select">
            <option disabled>Select option</option>
            @foreach ($agents as $agent)
            <option value="{{$agent['name']}}">{{$agent['name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-2">
            <label>Supervisor Name</label>
          <select class="custom-select"id="supervisor_name" name="supervisor_name" data-placeholder="select">
            <option disabled>Select option</option>
            @foreach ($supervisor as $row)
            <option value="{{$row['name']}}">{{$row['name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-2">
            <label>Category</label>
          <select class="custom-select"id="category" name="call_category" data-placeholder="select">
            <option disabled>Select option</option>
            @foreach ($category as $categories)
            <option value="{{$categories['category_name']}}">{{$categories['category_name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-2">
            <label>Quality Analyst</label>
          <select class="custom-select"id="qa" name="qa_name" data-placeholder="select">
            <option disabled>Select option</option>
            @foreach ($qa as $qas)
            <option value="{{$qas['name']}}">{{$qas['name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-2">
            <label>Call Rating</label>
            <select class="custom-select"id="call_rating" name="call_rating" data-placeholder="select">
                <option disabled>Select option</option>
            @foreach ($callrating as $callratings)
            <option value="{{$callratings['id']}}">{{$callratings['rating_name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="col-2">
            <label>Date</label>
                <input type="date" name="call_date" class="form-control" placeholder="call_date">
        </div>
      </div>
      <hr>
        <div class="card-body">
          <div id="actions" class="row-4">
            <div class="container">
            <div class="col">
              <div class="btn-group w-100">
                <span input class="btn btn-success col start">
                    <input type="file" name="call_file" >
                </span>
                <button type="submit" class="btn btn-primary col start">
                  <i class="fas fa-upload"></i>
                  <span>Start upload</span>
                </button>
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
</form>
</div>
<div class="card-body">
    <table class="table table-bordered" id="questionsTable">
        <thead>
            <tr>
                <th>Agent</th>
                <th>Supervisor </th>
                <th>Category</th>
                <th>Quality Analyts</th>
                <th>Call Rating</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($upload as $uploads)
            <tr>
                <td>{{$uploads['agent_name']  }}</td>
                <td>{{ $uploads['supervisor_name'] }}</td>
                <td>{{ $uploads['call_category'] }}</td>
                <td>{{ $uploads['qa_name'] }}</td>
                <td>{{ $uploads['rating_name'] }}</td>
                <td>{{$uploads['call_date']  }}</td>
                <th>
                    {{-- <a href="" class="btn btn-success"><i class="fas fa-play" ></i></a>
                    <a href="" class="btn btn-info"><i class="fas fa-pause" ></i></a>
                    <a href="" class="btn btn-warning"><i class="fas fa-stop" ></i></a> --}}

                    <audio controls class="btn btn-success" >
                        <source src="/assets/{{$uploads->call_file }}" type="audio/mp3">
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
@stop
