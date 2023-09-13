@extends('adminlte::page')

@section('title', 'Produtivity-Reports')

@section('content_header')
    <h1 hidden>Produtivity</h1>
@stop

@section('content')

<div class="card card-success ">
    <div class="card-header">
    <input readonly class="form-control" style="color: green" name="category" value="Productivity">
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('produtivity.show') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
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
                        <label for="section">Country</label>
                        <div class="form-group">
                            <select class="form-control" required="required" id="country" name="country"><option selected="selected" value="">--Select Country--</option>
                                @foreach ($country as $cty)
                                <option value="{{ $cty['id'] }}">{{ $cty['country_name'] }}</option>
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
                                <label for="service[]">Select Category</label>
                                <div class="form-group">
                                    <select class="form-control" required="required" id="category" name="category"><option  value="">--Select Category--</option>
                                        {{-- @foreach ($category as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['category_name'] }}</option>
                                        @endforeach --}}
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
                       <input type="text" required="required" name="created_at"  class="form-control daterange" id="reservation">
                     </div>
                     <!-- /.input group -->
                   </div>
                 </div>
              </div>
              @can('view-productivity-button-reports')
              <div class="row">
                <div class="col">
                    <button type="submit"   class="btn-success float-right">Search</button>
                    </div>
              </div>
              @endcan
        </div>
    </div>
</form>
</div>
<div class="card card">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" value="Quality Report">
       </div>
        <div class="card-body">
            @if (count($productivityresults) > 0)

            <div class="table-responsive">
                <table class="table table-bordered" id="questionsTable">
                    <thead>
                                <tr>
                                    <th>Agent</th>
                                    <th>Supervsior</th>
                                    <th>Quality Analysts</th>
                                    <th>Country</th>
                                    <th>Services</th>
                                    <th>Category</th>
                                    <th>Customer Code</th>
                                    <th>Recording ID</th>
                                    <th>date</th>
                                    <th>Week</th>
                                    <th>Month</th>
                                    <th>Status</th>
                                    <th>Auto-Fail</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productivityresults as $productivityresult)


                                <tr>
                                    <td>{{ $productivityresult['agentName'] }}</td>
                                    <td>{{ $productivityresult['SupervisorName'] }}</td>
                                    <td>{{ $productivityresult['qualityName'] }}</td>
                                    <td>{{ $productivityresult['country_name'] }}</td>
                                    <td>
                                        @if ($productivityresult->s_id == '1')
                                        <a disable class="badge badge-success" >Cable</a>
                                        @else
                                        <a disable class="badge badge-primary" >DTH</a>
                                        @endif
                                    </td>
                                    <td>{{ $productivityresult['category_name'] }}</td>
                                    <td>{{ $productivityresult['customer_account'] }}</td>
                                    <td>{{ $productivityresult['recording_id'] }}</td>
                                    <td>{{ $productivityresult['date_recorded'] }}</td>
                                    <td>{{ $productivityresult['weekNumberWithPrefix'] }}</td>
                                       <td>{{ $productivityresult['monthName'] }}</td>
                                       <td>
                                        @switch($productivityresult['status'] )
                                        @case($productivityresult['status'] == '3')
                                               <a disable class="badge badge-success" >Completed</a>
                                            @break
                                       @case($productivityresult['status']  == '2')
                                             <a disable class="badge badge-warning" >pending</a>
                                              @break
                                       @case($productivityresult['status']  == '1')
                                               <a disable class="badge badge-danger" >Slipping</a>
                                          @break

                                             @default

                                        @endswitch

                                      </td>

                                    <td>
                                        @if ($productivityresult['autoFail'] == $productivityresult['id'])
                                        <a disable class="badge badge-danger" >Auto-fail registered</a>
                                        @else
                                        <a disable class="badge badge-success" >No Auto-fail</a>
                                        @endif
                                    </td>
                                    <td>{{ $productivityresult['final_results'] }}%</td>
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

            @if (count($productivityexams) > 0)

            <label>{{ $productivityexams[0]['type_name'] }}</label>

            <div class="table-responsive">
                <table class="table table-bordered" id="questionsTable1">
                    <thead>
                                <tr>
                                    <th>Agent</th>
                                    <th>Supervsior</th>
                                    <th>Quality Analysts</th>
                                    <th>Country</th>
                                    <th>Services</th>
                                    <th>Category</th>
                                    <th>Customer Code</th>
                                    <th>Recording ID</th>
                                    <th>date</th>
                                    <th>Week</th>
                                    <th>Month</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productivityexams as $productivityexam)


                                <tr>
                                    <td>{{ $productivityexam['agentName'] }}</td>
                                    <td>{{ $productivityexam['SupervisorName'] }}</td>
                                    <td>{{ $productivityexam['qualityName'] }}</td>
                                    <td>{{ $productivityexam['country_name'] }}</td>
                                    <td>
                                        @if($productivityexam->s_id == '1')
                                        <a disable class="badge badge-success" >Cable</a>
                                        @else
                                        <a disable class="badge badge-primary" >DTH</a>
                                        @endif
                                    </td>
                                    <td>{{ $productivityexam['category_name'] }}</td>
                                    <td>{{ $productivityexam['customer_account'] }}</td>
                                    <td>{{ $productivityexam['recording_id'] }}</td>
                                    <td>{{ $productivityexam['date_recorded'] }}</td>
                                    <td>{{ $productivityexam['weekNumberWithPrefix'] }}</td>
                                    <td>{{ $productivityexam['monthName'] }}</td>
                                    <td>{{ $productivityexam['final_results'] }}%</td>
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
                            .model_id + '">' + value.name + '</option>');
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
                            .model_id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>

@stop
