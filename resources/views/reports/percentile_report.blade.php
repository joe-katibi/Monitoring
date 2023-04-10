@extends('adminlte::page')

@section('title', 'Percentile-Reports')

@section('content_header')
    <h1 hidden >Percentile Report</h1>
@stop

@section('content')

<div class="card card-success ">
     <div class="card-header">
       <input readonly class="form-control" style="color: green" name="category" value="Percentile Report">
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('percentile.show') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
            @csrf
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
                    <label for="service"> Country</label>
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

                      <div class="col-md-4">
                       <!-- Date range -->
                          <div class="form-group">
                           <label>Date range:</label>
                        <div class="input-group">
                         <div class="input-group-prepend">
                           <span class="input-group-text"> <i class="far fa-calendar-alt"></i> </span>
                           </div>
                       <input type="text" name="created_at" class="form-control daterange" id="reservation">
                                                 </div>
     <!-- /.input group -->
   </div>
    </div>
  </div>
  @can('view-percentile-button-reports')
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
    <div class="card-header">
        <input readonly class="form-control" style="color: green" value="Quality Report">
       </div>
<div class="card-body">
    @if (count($percentileresults) > 0)

    <div class="table-responsive">
        <table class="table table-bordered" id="questionsTable">
            <thead>
                        <tr>
                            <th>Category</th>
                            <th>Parameter</th>
                            <th>Service</th>
                            <th>Country</th>
                            <th>Date</th>
                            <th>Week</th>
                            <th>Month</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($percentileresults as $percentileresult)


                        <tr>
                            <td>{{ $percentileresult['category_name'] }}</td>
                            <td>{{ $percentileresult['summarized'] }}</td>
                            <td>

                                @if ($percentileresult->s_id == '1')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif


                            </td>
                            <td>{{ $percentileresult['country_name'] }}</td>
                            <td>{{ $percentileresult['date_recorded'] }}</td>
                            <td>{{ $percentileresult['weekNumberWithPrefix'] }}</td>
                            <td>{{ $percentileresult['monthName'] }}</td>
                            <td>{{ $percentileresult['marks'] }}%</td>

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
    @if (count($percentilecourse) > 0)
    <div class="table-responsive">
        <table class="table table-bordered" id="questionsTable1">
            <thead>
                        <tr>
                            <th>Course</th>
                            <th>Category</th>
                            <th>Service</th>
                            <th>Country</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($percentilecourse as $percentilecourses)

                        <tr>
                            <td>{{ $percentilecourses['course_name'] }}</td>
                            <td>{{ $percentilecourses['category_name'] }}</td>
                            <td>
                                {{-- {{ $percentilecourses['service_name'] }} --}}
                                @if ($percentilecourses->s_id == '1')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif

                            </td>
                            <td>{{ $percentilecourses['country_name'] }}</td>
                            <td>{{ $percentilecourses['marks_achieved'] }}%</td>

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



@stop
