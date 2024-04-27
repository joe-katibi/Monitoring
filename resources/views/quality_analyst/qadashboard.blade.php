@extends('adminlte::page')

@section('title', 'QA-Dashboard')

@section('content_header')
    <h1 hidden>QA Dashboard</h1>
@stop

@section('content')

<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green"  value="Quality Analyst Dashboard">
    </div>

     <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
                <div class="card-header">
                    <input readonly class="form-control" style="color: green" value="Quality Audits">
                   </div>
            <div class="row">
              <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $auditTotal }}</h3>

                    <p>Agents Audited</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $auditCompleted }}</h3>
                    {{-- <sup style="font-size: 20px">%</sup> --}}
                    <p>Completed tickets</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ $auditPending  }}</h3>

                    <p>Pending tickets</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{ $auditSlipping }}</h3>

                    <p>Slipping tickets</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pending-actions"></i>
                  </div>
                </div>
              </div>

              <!-- ./col -->
            </div>
            <div class="card-header">
                <input readonly class="form-control" style="color: green" value="Auto Fails">
               </div>
        <div class="row">
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $autoTotal }}</h3>
                <p>Agents with Auto Fails</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $autoCompleted }}</h3>
                {{-- <sup style="font-size: 20px">%</sup> --}}
                <p>Completed Auto Fails</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $autoPending  }}</h3>

                <p>Pending Auto Fails</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $autoSlipping }}</h3>

                <p>Slipping Auto Fails</p>
              </div>
            </div>
          </div>

          <!-- ./col -->
        </div>
        <div class="card-header">
            <input readonly class="form-control" style="color: green" value="Graph">
           </div>

    <div class="row" >
        <div class="col" style="width: 750px; height: 500px;">
            <canvas id="weekly-chart" ></canvas>

        </div>

        <div class="col" style="width: 750px; height: 500px;">
            <canvas id="monthly-chart"></canvas>

        </div>

    </div>
</div>


 </section>




@stop

@section('css')

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var weeklyData = {!! json_encode($weeklyData) !!};
    var weeklyLabels = {!! json_encode($weeklyLabels) !!};

    var ctx = document.getElementById('weekly-chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: weeklyLabels,
            datasets: [{
                label: 'Weekly Final Results',
                data: weeklyData,
                backgroundColor: 'orange',
                borderColor: 'orange',
                borderWidth: 1,
                type: 'bar'
            }, ]
        },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 90
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return value.toLocaleString() + ' (' + (value/chart.config.data.datasets[0].data.reduce((a,b) => a + b, 0) * 100).toFixed(2) + '%)';
                        }
                    }
                }]
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        var label = data.labels[tooltipItem.index];
                        return datasetLabel + ': ' + value.toLocaleString() + ' (' + (value/chart.config.data.datasets[0].data.reduce((a,b) => a + b, 0) * 100).toFixed(2) + '%)';
                    }
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    font: {
                        size: 14,
                    },
                    formatter: function(value, context) {
                        return value.toLocaleString();
                    }
                }
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: 'black',
                    fontSize: 14
                }
            }
        }
    });
</script>

<script>
    var monthlyData = {!! json_encode($monthlyData) !!};
    var monthlyLabels = {!! json_encode($monthlyLabels) !!};

    var ctx = document.getElementById('monthly-chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Final Results',
                data: monthlyData,
                backgroundColor: 'green',
                borderColor: 'green',
                borderWidth: 1,
                type: 'bar'
            }, ]
        },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 90
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return value.toLocaleString() + ' (' + (value/chart.config.data.datasets[0].data.reduce((a,b) => a + b, 0) * 100).toFixed(2) + '%)';
                        }
                    }
                }]
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        var label = data.labels[tooltipItem.index];
                        return datasetLabel + ': ' + value.toLocaleString() + ' (' + (value/chart.config.data.datasets[0].data.reduce((a,b) => a + b, 0) * 100).toFixed(2) + '%)';
                    }
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    font: {
                        size: 14,
                    },
                    formatter: function(value, context) {
                        return value.toLocaleString();
                    }
                }
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: 'black',
                    fontSize: 14
                }
            }
        }
    });
</script>
@stop
