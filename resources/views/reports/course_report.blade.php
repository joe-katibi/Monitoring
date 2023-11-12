@extends('adminlte::page')

@section('title', 'Courses-Reports')

@section('content_header')
    <h1 hidden></h1>
@stop

@section('content')

    <div class="card card-success ">
        <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Course report">
        </div>
        <form method="GET" action="{{  route('course_report.show')}}" accept-charset="UTF-8" class="form" ><input name="_token" type="hidden" value="">
            @csrf
        <div class="card-body">
            <div class="row ">
                <div class="col-md-2">
                    <label for="section">Select Country</label>
                    <div class="form-group">
                     <select class="form-control" required="required" id="country" name="country"><option selected="selected" value="">--Select Country--</option>
                         @foreach ($country as $item)
                         <option value="{{ $item['id'] }}">{{ $item['country_name'] }}</option>
                         @endforeach
                     </select>
                    </div>
                    </div>
                    <div class="col-md-2">
                        <label for="section">Select service</label>
                        <div class="form-group">
                            <select class="form-control" required="required" id="service" name="service"><option selected="selected" value="">--Select service--</option>
                                @foreach ($services as $service)
                                <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-md-2">
                            <label for="service[]">Select Courses</label>
                            <div class="form-group">
                                <select class="form-control" required="required" id="course" name="course"><option selected="selected" value="">--Select Courses--</option>
                                    {{-- @foreach ($course as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['course_name'] }}</option>
                                    @endforeach --}}
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
                               <input type="text"  name="created_at" class="form-control daterange" id="reservation">
                             </div>
                             <!-- /.input group -->
                           </div>
                      </div>
                    </div>
                    @can('view-course-button-report')
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn-success float-right">Search</button>
                            </div>
                      </div>
                    @endcan
                    </div>
                </form>
            </div>

            <div class="card card">
                <div class="card-body">
                    @if ($services[0]['id'] > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" id="questionsTable">
                            <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Country</th>
                                            <th>Services</th>
                                            <th>Date</th>
                                            <th>Week</th>
                                            <th>Month</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coursereports as $course)
                                        <tr>
                                            <td>{{ $course['course_name'] }}</td>
                                            <td>{{ $course['country_name'] }}</td>
                                            <td>
                                                {{-- {{ $course['service_name'] }} --}}

                                                @if ($course->s_id == '1')
                                                <a disable class="badge badge-success" >Cable</a>
                                                @else
                                                <a disable class="badge badge-primary" >DTH</a>
                                                @endif

                                            </td>
                                            <td>{{ $course['created_at'] }}</td>
                                            <td>{{ $course['weekNumberWithPrefix'] }}</td>
                                            <td>{{ $course['monthName'] }}</td>
                                            <td>{{ $course['marks_achieved'] }}%</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @else
                    <p>No results found.</p>
                    @endif


            </div>


@stop

@section('css')
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

@stop