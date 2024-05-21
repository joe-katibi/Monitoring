@extends('adminlte::page')

@section('title', 'Exam-Results | Zuku Monitoring')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form action="{{ route('examresult.store') }}" method="POST" name="listForm">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Exam Results">
        </div>
        <div class="card-body">
            <div class="row">
            @can('admin-agent-exam-results')
            <div class="col-md-4">
                <label for="section">Agent</label>
                 <div class="form-group">
                   <select class="form-control" required="required" name="agent"><option selected="selected" value="">--Select Agent--</option>
                    <option value="{{$userLogged['id']}}">{{ $userLogged['name'] }}</option>
              </select>
              </div>
              </div>
              @endcan
              @can('admin-supervisor-quality-exam-results')
              <div class="col-md-4">
                <label for="section">Agent</label>
                 <div class="form-group">
                   <select class="form-control" required="required" name="agent"><option selected="selected" value="">--Select Agent--</option>
                    @foreach ($agents as $agent)
                    <option value="{{$agent['id']}}">{{ $agent['name'] }}</option>
                    @endforeach
              </select>
              </div>
              </div>
              @endcan
                <div class="col-md-4">
                    <label for="section">Service</label>
                     <div class="form-group">
                    <select class="form-control" required="required" id="service" name="service"><option selected="selected" value="">--Select Service--</option>
                    @foreach ($services as $service)
                    <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                    @endforeach
                   </select>
                 </div>
               </div>
                <div class="col-md-4">
                    <label for="section">Course</label>
                     <div class="form-group">
                <select class="form-control" required="required" id="course" name="course"><option selected="selected" value="">--Select Course--</option>

                   </select>
                 </div>
               </div>
                {{-- <div class="col-md-4">
                    <label for="section">Exam name</label>
                    <select class="form-control" required="required" id="exam" name="exam_name"><option selected="selected" value="">--Exam Name--</option>

                   </select>
                </div> --}}
             <div class="col-md-4">
               <label for="section">Department</label>
                <div class="form-group">
               <select class="form-control" required="required" id="department" name="department"><option selected="selected" value="">--Select Department--</option>

                 </select>
                </div>
               </div>
               <div class="col-md-4">
              <!-- Date range -->
             <div class="form-group">
              <label>Date range:</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
               </div>
               <input type="text" name="created_at"class="form-control daterange" id="reservation">
             </div>
               <!-- /.input group -->
            </div>
          </div>
    </div>
    @can('view-results-audit-button')
      <div class="col">
        <button type="submit" class="btn btn-success float-right" ><strong>Search</strong></button>
     </div>
     @endcan
    </div>
</form>
<div class="card-body">
          <table class="table table-bordered" id="questionsTable">
              <thead>
                  <tr>
                      {{-- <th style="width: 10px">No</th> --}}
                      <th style="width: 15%">Exam Name</th>
                      <th>Course</th>
                      <th>Service</th>
                      <th>Agent Name</th>
                      <th>Department</th>
                      <th>Total Results</th>
                      <th>Date</th>
                      <th style="width: 10%">Action</th>
                  </tr>
              </thead>
                  <tbody>
                        @foreach ($examresults as $key=>$row)
                         <tr>
                               <td>{{ $row['exam_name'] }}</td>
                               <td>{{ $row['course_name'] }}</td>
                               <td>

                                {{-- {{ $row['service_name'] }} --}}

                                @if ($row->s_id == '1')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif



                            </td>
                               <td>{{ $row['name'] }}</td>
                               <td>{{ $row ['category_name']}}</td>
                               <td>{{ $row ['marks_achieved']}}%</td>
                               <td>{{ $row['created_at'] }}</td>
                               {{-- <td>{{ $row }}</td> --}}
                               <td>
                                   <div class="btn-group btn-group-sm">


                                       <a href="{{ route('examresult.edit',[$row->id, $row->schedule_id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                       {{-- <a href="{{ route('examresult.show', ['examresult' => $row['id'], 'schedule_id' => $row['schedule_id']]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a> --}}

                                   </div>


                          </td>
                      </tr>
                  @endforeach

                  </tbody>
              </table>
          </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link href="/assets/css/dataTables.min.css" rel="stylesheet">
<link href="/assets/css/buttons.bootstrap4.min.css" rel="stylesheet">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script src="/assets/js/dataTables.min.js"></script>
<script src="/assets/js/pdfmake.min.js"></script>
<script src="/assets/js/vfs_fonts.js"></script>
<script src="/assets/js/buttons.print.min.js"></script>
<script src="/assets/js/buttons.colVis.js"></script>
<script src="/assets/js/buttons.html5.js"></script>
<script src="/assets/js/buttons.jszip.min.js"></script>

<script>
    $(document).ready(function() {
        $('.daterange').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY/MM/DD hh:mm:ss'
            }
        });

        $('#questionsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]

        });

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
            $("#course").html('');
            $.ajax({
                url: '/course-report/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#course').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#course").append('<option value="' + value
                            .id + '">' + value.course_name + '</option>');
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
        Service Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#course').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#exam").html('');
            $.ajax({
                url: '/course-exam/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#exam').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#exam").append('<option value="' + value
                            .id + '">' + value.exam_name + '</option>');
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
        Service Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#service').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#department").html('');
            $.ajax({
                url: '/auto-fail/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#department').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#department").append('<option value="' + value
                            .id + '">' + value.category_name + '</option>');
                    });

                }
            });
        });

    });
</script>


@stop
