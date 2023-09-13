@extends('adminlte::page')

@section('title', 'Auto-Fails-Reports')

@section('content_header')
    <h1 hidden>Auto Fails Report</h1>
@stop

@section('content')

    <div class="card card-success ">
        <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Auto Fails Report">
        </div>
        <form method="GET" action="{{ route('autofailreport.show') }}" accept-charset="UTF-8" class="form" ><input name="_token" type="hidden" value="">
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
                            <select class="form-control" required="required" id="category" name="category"><option  value="">--Select Category--</option>
                                {{-- @foreach ($category as $item)
                                <option value="{{ $item['id'] }}">{{ $item['category_name'] }}</option>
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
                               <input type="text" name="created_at" class="form-control daterange" id="reservation">
                             </div>
                             <!-- /.input group -->
                           </div>
                      </div>
                    </div>
                    @can('view-autofail-button-reports')
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
                                                <th>Agent</th>
                                                <th>Supervsior</th>
                                                <th>Quality Analysts</th>
                                                <th>Category</th>
                                                <th>Services</th>
                                                <th>Country</th>
                                                <th>Customer Code</th>
                                                <th>date</th>
                                                <th>Week</th>
                                                <th>Month</th>
                                                <th>Auto Fail Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($autofailreports as $row)

                                            <tr>
                                                <td> {{ $row['agentName'] }} </td>
                                                <td>{{ $row['SupervisorName'] }} </td>
                                                <td>{{ $row['qualityName'] }}</td>
                                                <td>{{ $row['category_name'] }}</td>
                                                <td>
                                                    @if ($row->s_id == '1')
                                                    <a disable class="badge badge-success" >Cable</a>
                                                    @else
                                                    <a disable class="badge badge-primary" >DTH</a>
                                                    @endif
                                                </td>
                                                <td>{{ $row['country_name'] }}</td>
                                                <td>{{ $row['customer_account'] }}</td>
                                                <td>{{ $row['created_at'] }}</td>
                                                <td>{{ $row['weekNumberWithPrefix']}}</td>
                                                <td>{{ $row['monthName']}}</td>
                                                <td>
                                                  @switch($row['auto_status'] )
                                                  @case($row['auto_status'] == '3')
                                                         <a disable class="badge badge-success" >Completed</a>
                                                      @break
                                                 @case($row['auto_status']  == '2')
                                                       <a disable class="badge badge-warning" >pending</a>
                                                        @break
                                                 @case($row['auto_status']  == '1')
                                                         <a disable class="badge badge-danger" >Slipping</a>
                                                    @break

                                                       @default

                                                  @endswitch

                                                </td>

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




   <!-- /.Test group -->




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
        Crm Dropdown Change Event
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


@stop
