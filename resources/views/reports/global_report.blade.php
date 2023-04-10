@extends('adminlte::page')

@section('title', 'Global-Reports')

@section('content_header')
<h1 hidden></h1>

@stop

@section('content')
<form method="get" action="{{ route('global.show') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
    @csrf
    <div class="card card-success ">
        <div class="card-header">
        <input readonly class="form-control" style="color: green"  value="Global Reports">
        </div>
        <div class="card-body">
            <div class="row">
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
                           <select class="form-control" required="required" id="services" name="service"><option selected="selected" value="">--Select service--</option>
                            @foreach ($services as $service)
                            <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
             <div class="col-md-3">
              <label for="section">Select Country</label>
               <div class="form-group">
            <select class="form-control" required="required" id="country" name="country"><option selected="selected" value="">--Select Country--</option>
                @foreach ($country as $countries)
                <option value="{{ $countries['id'] }}">{{ $countries['country_name'] }}</option>
                @endforeach
                  </select>
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
       <input type="text" name="created_at" class="form-control daterange" id="reservation">
    </div>
    <!-- /.input group -->
  </div>
</div>
</div>
@can('view-global-button-reports')
<div class="row">
    <div class="col">
<button type="submit" class="btn-success float-right">Submit</button>
</div>
</div>
@endcan
</div>
</div>
</form>
<div class="card card">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" value="Quality Report">
       </div>
<div class="card-body">
    @if (count($auditresults) > 0)
    <table class="table table-bordered" id="questionsTable">
        <thead>
            <tr>
                <th>Country</th>
                <th>Services</th>
                <th>Date</th>
                <th>Week</th>
                <th>Month</th>
                <th>Results</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditresults as $audits)

            <tr>
                <td>{{ $audits['country_name'] }}</td>
                <td>
                    @if ($audits->services == '1')
                    <a disable class="badge badge-success" >Cable</a>
                    @else
                    <a disable class="badge badge-primary" >DTH</a>
                    @endif
                </td>
                <td>{{ $audits['date_recorded'] }}</td>
                <td>{{ $audits['weekNumberWithPrefix'] }}</td>
                <td>{{ $audits['monthName'] }}</td>
                <td>{{ $audits['final_results'] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
    @if (count($examresults) > 0)
    <table class="table table-bordered" id="questionsTable1">
        <thead>
            <tr>
                <th>Country</th>
                <th>Services</th>
                <th>Date</th>
                <th>Week</th>
                <th>Month</th>
                <th>Results</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examresults as $exams)
            <tr>
                <td>{{ $exams['country_name'] }}</td>
                <td>
                    @if ($exams->services == '1')
                    <a disable class="badge badge-success" >Cable</a>
                    @else
                    <a disable class="badge badge-primary" >DTH</a>
                    @endif
                </td>
                <td>{{ $exams['created_at'] }}</td>
                <td>{{ $exams['weekNumberWithPrefix'] }}</td>
              <td>{{ $exams['monthName'] }}</td>
                <td>{{ $exams['marks_achieved'] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No results found.</p>
    @endif


</div>
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
