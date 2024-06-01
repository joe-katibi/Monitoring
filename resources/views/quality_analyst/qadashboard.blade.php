@extends('adminlte::page')

@section('title', 'QA-Dashboard | Zuku Monitoring')

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

    <div>

            <div id="chart"></div>

            <div id="monthly-chart"></div>

        </div>

    </div>
</div>


 </section>




@stop

@section('css')


<style>

    #chart {
  max-width: 650px;
  margin: 35px auto;
}

</style>


@stop

@section('js')

<script>
    window.Promise ||
      document.write(
        '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
      )
    window.Promise ||
      document.write(
        '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
      )
    window.Promise ||
      document.write(
        '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
      )
  </script>


  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <script>
      var weeklyData = {!! json_encode($weeklyData) !!};
      var weeklyLabels = {!! json_encode($weeklyLabels) !!};

      var totalDataSum = weeklyData.reduce((a, b) => a + b, 0);

      var options = {
          series: [{
              name: 'Weekly Final Results',
              data: weeklyData
          }],
          chart: {
              type: 'bar',
              height: 350
          },
          plotOptions: {
              bar: {
                  horizontal: false,
              }
          },
          dataLabels: {
              enabled: true,
              formatter: function (value) {
                  return value.toLocaleString();
              },
              style: {
                  fontSize: '14px'
              }
          },
          xaxis: {
              categories: weeklyLabels,
              labels: {
                  rotate: -90,
                  rotateAlways: true,
                  formatter: function (val) {
                      return val;
                  }
              }
          },
          yaxis: {
              title: {
                  text: 'Values'
              },
              labels: {
                  formatter: function (value) {
                      return value.toLocaleString() + ' (' + ((value / totalDataSum) * 100).toFixed(2) + '%)';
                  }
              }
          },
          tooltip: {
              y: {
                  formatter: function (value) {
                      return value.toLocaleString() + ' (' + ((value / totalDataSum) * 100).toFixed(2) + '%)';
                  }
              }
          },
          title: {
              text: 'Weekly Final Results',
              align: 'center',
              style: {
                  fontSize: '20px',
                  color: '#263238'
              }
          },
          legend: {
              position: 'top',
              horizontalAlign: 'center',
              floating: false,
              fontSize: '14px',
              labels: {
                  colors: ['black'],
                  useSeriesColors: false
              }
          }
      };

      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
  </script>

<script>
    var monthlyData = {!! json_encode($monthlyData) !!};
    var monthlyLabels = {!! json_encode($monthlyLabels) !!};

    var totalMonthlyDataSum = monthlyData.reduce((a, b) => a + b, 0);

    var options = {
        series: [{
            name: 'Monthly Final Results',
            data: monthlyData
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (value) {
                return value.toLocaleString();
            },
            style: {
                fontSize: '14px'
            }
        },
        xaxis: {
            categories: monthlyLabels,
            labels: {
                rotate: -90,
                rotateAlways: true,
                formatter: function (val) {
                    return val;
                }
            }
        },
        yaxis: {
            title: {
                text: 'Values'
            },
            labels: {
                formatter: function (value) {
                    return value.toLocaleString() + ' (' + ((value / totalMonthlyDataSum) * 100).toFixed(2) + '%)';
                }
            }
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return value.toLocaleString() + ' (' + ((value / totalMonthlyDataSum) * 100).toFixed(2) + '%)';
                }
            }
        },
        title: {
            text: 'Monthly Final Results',
            align: 'center',
            style: {
                fontSize: '20px',
                color: '#263238'
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'center',
            floating: false,
            fontSize: '14px',
            labels: {
                colors: ['black'],
                useSeriesColors: false
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#monthly-chart"), options);
    chart.render();
</script>



@stop
