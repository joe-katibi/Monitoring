@extends('adminlte::page')

@section('title', 'Categories-Reports')

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
                                        <th>date</th>
                                        <th>Week</th>
                                        <th>Month</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryreport as $categorys)

                                    <tr>
                                        <td>{{ $categorys['category_name'] }}</td>
                                        <td>{{ $categorys['country_name'] }}</td>
                                        <td>
                                            {{-- {{ $categorys['service_name'] }} --}}

                                            @if ($categorys->s_id == '1')
                                            <a disable class="badge badge-success" >Cable</a>
                                            @else
                                            <a disable class="badge badge-primary" >DTH</a>
                                            @endif

                                        </td>
                                        <td>{{ $categorys['date_recorded'] }}</td>
                                        <td>{{ $categorys['weekNumberWithPrefix'] }}</td>
                                        <td>{{ $categorys['monthName'] }}</td>
                                        <td>{{ $categorys['final_results'] }}%</td>
                                    </tr>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@stop

@section('js')
<script>

    questionsTable = $('#questionsTable').dataTable({

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
