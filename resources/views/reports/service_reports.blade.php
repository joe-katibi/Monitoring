@extends('adminlte::page')

@section('title', 'Services-Reports')

@section('content_header')
    <h1 hidden>Services Reports</h1>
@stop

@section('content')

<div class="card card-success ">
    <div class="card-header">
    <input readonly class="form-control" style="color: green" name="category" value="Services Reports">
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('servicereport.show') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
            @csrf
<div class="page-wrapper">
         <div class="row ">
            <div class="col-md-2">
                <label for="section">Select type of Report</label>
                <div class="form-group">
                   <select class="form-control" required="required" id="report_type_id" name="report_type_id"><option selected="selected" value="">--Select Type of Report--</option>
                    @foreach ($reporttype as $typereport)
                    <option value="{{ $typereport['id'] }}">{{$typereport['type_name'] }}</option>
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
            <div class="col-sm-6 col-md-3">
                <div class="col-md-12">
                    <label for="section">Country</label>
                    <div class="form-group">
                        <select class="form-control" required="required" id="country" name="country"><option selected="selected" value="">--Select Country--</option>
                            @foreach ($country as $item)
                            <option value="{{ $item['id'] }}">{{ $item['country_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
               </div>
                <div class="col-md-5">
                    <!-- Date range -->
                    <div class="form-group">
                     <label>Date range:</label>

                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text">
                           <i class="far fa-calendar-alt"></i>
                         </span>
                       </div>
                       <input type="text" name="created_at" class="form-control daterange" id="reservationtime">
                     </div>
                     <!-- /.input group -->
                   </div>
                 </div>
              </div>
              @can('view-service-button-reports')
              <div class="row">
                <div class="col">
                    <button type="submit"  class="btn-success float-right">Search</button>
                </div>
              </div>
              @endcan

        </div>
    </form>
</div>
</div>
<div class="card card">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" value="Quality Report">
       </div>
        <div class="card-body">
            @if (count($servicereport1) > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="questionsTable">
                    <thead>
                                <tr>
                                    <th>Services</th>
                                    <th>Country</th>
                                    <th>Agent</th>
                                    <th>Supervisor</th>
                                    <th>Quality Analysts</th>
                                    <th>Customer Code</th>
                                    <th>Recording ID</th>
                                    <th>Date</th>
                                    <th>Week</th>
                                    <th>Month</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicereport1 as $servicereports)
                                <tr>
                                    <td>
                                        @if ($servicereports->s_id == '1')
                                        <a disable class="badge badge-success" >Cable</a>
                                        @else
                                        <a disable class="badge badge-primary" >DTH</a>
                                        @endif

                                    </td>
                                     <td>{{ $servicereports['country_name'] }}</td>
                                    <td>{{ $servicereports['agentName'] }}</td>
                                    <td>{{ $servicereports['SupervisorName'] }}</td>
                                    <td>{{ $servicereports['qualityName'] }}</td>
                                    <td>{{ $servicereports['customer_account'] }}</td>
                                    <td>{{ $servicereports['recording_id'] }}</td>
                                    <td>{{ $servicereports['date_recorded'] }}</td>
                                    <td>{{ $servicereports['weekNumberWithPrefix'] }}</td>
                                     <td>{{ $servicereports['monthName'] }}</td>
                                    <td>{{ $servicereports['final_results'] }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


            @else
            <p>No results found.</p>

            @endif
        </div>
    </div>
    <div class="card card">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" value="Examination Report">
           </div>
           <div class="card-body">
            @if (count($servicereport) > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="questionsTable1">
                    <thead>
                                <tr>
                                    <th>Services</th>
                                    <th>Country</th>
                                    <th>Agent</th>
                                    <th>Supervisor</th>
                                    <th>Trainer</th>
                                    <th>Customer Code</th>
                                    <th>Recording ID</th>
                                    <th>date</th>
                                    <th>Week</th>
                                    <th>Month</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicereport as $servicereprts)
                                <tr>
                                    <td>
                                        @if ($servicereprts->s_id == '1')
                                        <a disable class="badge badge-success" >Cable</a>
                                        @else
                                        <a disable class="badge badge-primary" >DTH</a>
                                        @endif
                                    </td>
                                    <td>{{ $servicereprts['country_name'] }}</td>
                                    <td>{{ $servicereprts['agentName'] }}</td>
                                    <td>{{ $servicereprts['SupervisorName'] }}</td>
                                    <td>{{ $servicereprts['trainerName'] }}</td>
                                    <td>{{ $servicereprts['exam_name'] }}</td>
                                    <td>{{ $servicereprts['course_name'] }}</td>
                                    <td>{{ $servicereprts['created_at'] }}</td>
                                    <td>{{ $servicereprts['weekNumberWithPrefix'] }}</td>
                                    <td>{{ $servicereprts['monthName'] }}</td>
                                    <td>{{ $servicereprts['marks_achieved'] }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


            @else
            <p>No results found.</p>

            @endif
        </div>
    </div>


@stop

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@stop

@section('js')

<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script>

<script>

    questionsTable = $('#questionsTable1').dataTable({

      "dom" : 'lfrtip'
    });

  </script>

<script  src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script  src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script  src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
	$('.daterange').daterangepicker(
        {
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY/MM/DD hh:mm:ss '
      }
    }

    );
</script>


@stop
