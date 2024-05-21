@extends('adminlte::page')

@section('title', 'Categories-Reports | Zuku Monitoring')

@section('content_header')
    <h1 hidden>Categories</h1>
@stop

@section('content')

<div class="card card-success ">
    <div class="card-header">
    <input readonly class="form-control" style="color: green" name="category" value="Category report">
    </div>
    <form method="GET" action="{{ route('categories_report.show') }}" accept-charset="UTF-8" class="form" ><input name="_token" type="hidden" value="">
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
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="section">Select Type</label>
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
                @can('view-category-button-reports')
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
                @if (count ($categoryreport) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="questionsTable">
                        <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Country</th>
                                        <th>Services</th>
                                        <th>Date/week/month</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupedResults as $key => $group)
                                    @foreach($group['results'] as $result)
                                        <tr>
                                            <td>{{ $result->category_name }}</td>
                                            <td>{{ $result->country_name }}</td>
                                            <td>
                                                @if ($result->s_id == '1')
                                                    <span class="badge badge-success">Cable</span>
                                                @else
                                                    <span class="badge badge-primary">DTH</span>
                                                @endif
                                            </td>
                                            <td>{{ $key }}</td>
                                            <td>{{ round($group['average'], 2) }}%</td>
                                        </tr>
                                        @break <!-- Break after displaying the parameter value once for each group -->
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
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
