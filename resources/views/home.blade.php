@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1></h1>

    <style>
        /* Style the chart divs */
        .chart-container {
          margin: 20px; /* Add margin for spacing */
          padding: 20px; /* Add padding for spacing and background color */
          background-color: #f5f5f5; /* Set background color */
          border: 1px solid #ccc; /* Add a border for separation */
          border-radius: 5px; /* Add rounded corners */
        }

        /* Set the height of the chart divs */
        .chart {
          height: 400px; /* Adjust the height as needed */
        }
      </style>
@stop

@section('content')
@include('sweetalert::alert')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green"  value="Best agents of the month">
    </div>
    <div class="container-fluid ">
        <div class="row">
            @foreach($agents as $country => $services)
            <div class="col-lg-5 mb-8">
                <div class="card card-outline border-primary" >
                    <h3 class="text-center">{{ $country }}</h3>
                    <div class="row">
                        @foreach($services as $service => $agentsData)
                        <div class="col-md-6">
                            <div class="card card-primary card-outline" >
                                @foreach($agentsData as $agent)
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="/assets/img/user1-128x128.jpg"
                                             alt="User profile picture">
                                             {{-- <img src="{{ $agent['profile_image'] }}" alt="{{ $agent['agent_name'] }}"> --}}
                                  </div>
                                  <div class="profile-username text-center">
                                    <h4>{{ $agent['agent_name'] }}</h4>
                                    <hr>
                                    <p>{{ $agent['department_name'] }}</p>
                                    <hr>
                                    <p>{{ $agent['country_name'] }} </p>
                                    <hr>
                                    <p>
                                        @if ($agent['service_name'] == 'Cable')
                                        <a disable class="badge badge-success" >Cable</a>
                                         @else
                                       <a disable class="badge badge-primary">DTH</a>
                                         @endif
                                    </p>
                                    <hr>
                                    <div class="small-audio-player text-center" style="width: 60px; ">
                                        <audio controls>
                                            <source src="/assets/{{ $agent['call_file'] }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>






    </div>
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title" >
                Brief of the Week
            </h3>
            @can('view-create-roles')
            <div class="card-tools">
                <div class="row">
                <a href="{{ route('summaryview') }}" data-toggle="modal" data-target="#exampleModal1" type="button" class="btn btn-success float-right" > New Brief</a>
                <div class="col">
                <a href="{{ route('summaryview') }}" data-toggle="modal" data-target="#exampleModal2" type="button" class="btn btn-info float-right" > View Briefs</a>
            </div>
            </div>
            </div>
            @endcan
        </div>

      <div class="card-body">
       <table class="table table-bordered" id="questionsTable">
        <thead>
        <tr>
            {{-- <th>NO</th> --}}
            <th>Topic</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($briefView as $briefViews)
        <tr>
        {{-- <td>{{ $briefViews['id'] }}</td> --}}
        <td>{{ $briefViews['brief_topic'] }}</td>
        <td>{{ $briefViews['brief_description']}}</td>
    </tr>
        @endforeach
    </tbody>
       </table>
    </div>
</div>

<div class="card card-info">
    <div class="card-header">
        <input readonly class="form-control" style="color: blue"  value="Weekly Summary">
    </div>
</div>


  <!-- Chart containers -->
  <div class="chart-container">
    <div class="chart" id="weekly_combo_chart"></div>
  </div>

  <div class="card-header">
    <input readonly class="form-control" style="color: blue"  value="Monthly Summary">
</div>

  <div class="chart-container">
    <div class="chart" id="monthly_combo_chart"></div>
  </div>
  </div>


                          <!-- Modal  1-->
                          <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"> Create New Brief of Week</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="{{ route('home.store') }}" method="POST">
                                    {{csrf_field()}}
                                    <label for="name">Brief Topic</label>
                                    <input required type="text" name="brief_topic" class="form-control">
                                    <label for="name">Brief Description</label>
                                    <input required type="text" name="brief_description" class="form-control" style="height: 100px;">

                                    <div class="col-ms-3">
                                      <div class="card-body">
                                          <div class="row">
                                            @can('view-save-voc-summary-button')
                                              <div class="col">
                                    <button type="submit" class="btn btn-success float-right">Save</button>
                                        </div>
                                        @endcan
                                        </div>
                                  </div>

                                  </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                              </div>
                            </div>
                             </div>


                          <!-- Modal  2-->
                          <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"> Briefs of Week</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered" id="questionsTable">
                                        <thead>
                                            <tr>
                                                <th >Brief Topic</th>
                                                <th>Brief Description</th>
                                                <th>Date Created</th>
                                                <th>Created by</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach ($briefs as $brief )
                                                <tr>
                                                    <td>{{ $brief['brief_topic'] }}</td>
                                                    <td>{{ $brief['brief_description']}}</td>
                                                    <td>{{ $brief['created_at'] }}</td>
                                                    <td>{{ $brief['name'] }}</td>
                                                    <td>
                                                        @if($brief['status'] == 1)
                                                              <a disable class="badge badge-success" >Active</a>
                                                         @else
                                                      <a disable class="badge badge-danger" >Inactive</a>
                                                         @endif
                                                    </td>
                                                    <td>  <div class="btn-group btn-group-sm">
                                                        @can('view-results-audit-edit')

                                                        <a  href="{{ route('home.edit',$brief['id']) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                         @can('view-results-audit-delete')
                                                         <a href="{{ route('home.destroy',$brief['id']) }}" class="btn btn-info"><i class="fa fa-trash-alt"></i></a>
                                                         @endcan

                                                         @can('view-results-audit-delete')
                                                         @if ($brief['status'] == 1)
                                                         <a href="{{ route('home.deactivate',$brief['id']) }}" class="btn btn-danger"><i class="fa fa-toggle-off"></i></a>
                                                         @else
                                                         <a href="{{ route('home.activate',$brief['id']) }}" class="btn btn-warning"><i class="fa fa-toggle-on"></i></a>
                                                         @endif

                                                         @endcan
                                                           </div></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                              </div>
                            </div>
                             </div>



@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/profile-box.css') }}">

    <style>
        .table-wrapper {
            overflow-x: auto;
            max-width: 100%;
        }

        .table-scroll {
            min-width: 600px; /* Adjust this value based on your requirements */
        }

        .fixed-column {
            position: sticky;
            left: 0;
            z-index: 1;
            background-color: #fff;
        }
    </style>
@stop

@section('js')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $("#create_role").click(function (e) {
            $("#role_id").val("-1");
            $("#role_name").val("");
            $("#role_description").val("");
            // $("#scheme_active").prop('checked', true);
            $("#role_form_modal").modal('show');
        });

});
</script>


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    // Load the Google Charts library
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Charts library is loaded
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
      drawWeeklyComboChart();
      drawMonthlyComboChart();
    }

    function drawWeeklyComboChart() {
      // Use PHP to generate JavaScript data arrays for the weekly chart
      var weeklyData = <?php echo json_encode($averages); ?>;

      // Extract the country names from the data for the chart labels
      var countries = Object.keys(weeklyData);

      // Prepare the data for the weekly chart (percentages and averages)
      var weeklyChartData = [['Week', 'Total'].concat(countries)];

      // Extract the week labels from the data
      var weekLabels = Object.keys(weeklyData[countries[0]]['weeks']);

      for (var week of weekLabels) {
        var weekRow = ['Week ' + week];
        var total = 0;
        for (var i = 0; i < countries.length; i++) {
          var value = weeklyData[countries[i]]['weeks'][week];
          weekRow.push(value);
          total += value;
        }
        weekRow.push(total);
        weeklyChartData.push(weekRow);
      }

      var weeklyData = google.visualization.arrayToDataTable(weeklyChartData);

      var weeklyOptions = {
        title: 'Weekly Totals and Averages',
        curveType: 'function',
        seriesType: 'bars',
        series: {1: {type: 'line'}},
        vAxis: { title: 'Percentage' }, // Customize the Y-axis title
        hAxis: { title: 'Week' } // Customize the X-axis title
      };

      var weeklyChart = new google.visualization.ComboChart(document.getElementById('weekly_combo_chart'));

      weeklyChart.draw(weeklyData, weeklyOptions);
    }

    function drawMonthlyComboChart() {
      // Use PHP to generate JavaScript data arrays for the monthly chart
      var monthlyData = <?php echo json_encode($averages); ?>;

      // Extract the country names from the data for the chart labels
      var countries = Object.keys(monthlyData);

      // Prepare the data for the monthly chart (percentages and averages)
      var monthlyChartData = [['Month', 'Total'].concat(countries)];

      // Extract the month labels from the data
      var monthLabels = Object.keys(monthlyData[countries[0]]['months']);

      for (var month of monthLabels) {
        var monthShortLabel = formatMonthLabel(month);
        var monthRow = [monthShortLabel];
        var total = 0;
        for (var i = 0; i < countries.length; i++) {
          var value = monthlyData[countries[i]]['months'][month];
          monthRow.push(value);
          total += value;
        }
        monthRow.push(total);
        monthlyChartData.push(monthRow);
      }

      var monthlyData = google.visualization.arrayToDataTable(monthlyChartData);

      var monthlyOptions = {
        title: 'Monthly Totals and Averages',
        curveType: 'function',
        seriesType: 'bars',
        series: {1: {type: 'line'}},
        vAxis: { title: 'Percentage' }, // Customize the Y-axis title
        hAxis: { title: 'Month' } // Customize the X-axis title
      };

      var monthlyChart = new google.visualization.ComboChart(document.getElementById('monthly_combo_chart'));

      monthlyChart.draw(monthlyData, monthlyOptions);
    }

    // Function to format month labels (e.g., "Jan-23")
    function formatMonthLabel(month) {
      var date = new Date(month);
      var monthName = date.toLocaleString('default', { month: 'short' });
      var year = date.getFullYear().toString().substr(-2); // Extract last 2 digits of the year
      return monthName + '-' + year;
    }
  </script>



@stop
