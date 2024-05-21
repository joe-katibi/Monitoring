@extends('adminlte::page')

@section('title', 'Global-Reports | Zuku Monitoring')

@section('content_header')
    <h1 hidden></h1>
@stop

@section('content')
    <form method="get" action="{{ route('global.show') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
        @csrf
        <div class="card card-success ">
            <div class="card-header">
                <input readonly class="form-control" style="color: green" value="Global Reports">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="section">Select type of Report</label>
                        <div class="form-group">
                            <select class="form-control" required="required" id="report_type_id" name="report_type_id">
                                <option selected="selected" value="">--Select Type of Report--</option>
                                @foreach ($reporttype as $typereport)
                                    <option value="{{ $typereport['id'] }}">{{ $typereport['type_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="section">Select service</label>
                        <div class="form-group">
                            <select class="form-control" required="required" id="services" name="service">
                                <option selected="selected" value="">--Select service--</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service['id'] }}">{{ $service['service_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="section">Select Country</label>
                        <div class="form-group">
                            <select class="form-control" required="required" id="country" name="country">
                                <option selected="selected" value="">--Select Country--</option>
                                @foreach ($country as $countries)
                                    <option value="{{ $countries['id'] }}">{{ $countries['country_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="section">Select Period</label>
                        <select class="form-control" id="duration_unit" name="duration_unit">
                            <option selected="selected" value="">--Select Type --</option>
                            <option value="month">Month</option>
                            <option value="week">Week</option>
                        </select>
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
                        <th>Week/Month</th>
                        <th>Average</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupedResults as $key => $group)
                    <tr>
                        <td>{{ $group['results']->first()->country_name }}</td>
                        <td>
                            @if ($group['results']->first()->services == '1')
                                <a disable class="badge badge-success">Cable</a>
                            @else
                                <a disable class="badge badge-primary">DTH</a>
                            @endif
                        </td>
                        <td>{{ $key }}</td>
                        <td>{{ round($group['average'], 2) }}%</td>
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
                            <th>Week/Month</th>
                            <th>Average</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupedResultsExam as $key => $group)
                        <tr>
                            <td>{{ $group['results']->first()->country_name }}</td>
                            <td>
                                @if ($group['results']->first()->services == '1')
                                    <a disable class="badge badge-success">Cable</a>
                                @else
                                    <a disable class="badge badge-primary">DTH</a>
                                @endif
                            </td>
                            <td>{{ $key }}</td>
                            <td>{{ round($group['average'], 2) }}%</td>
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


        $('#questionsTable1').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@stop
