@extends('adminlte::page')

@section('title', 'Home | Zuku Monitoring')

@section('content_header')

<div class="card card-info">
    <div class="card-header">
        <input readonly class="form-control" style="color: blue"  value="Weekly Summary">
    </div>
</div>


  {{-- <!-- Chart containers -->
  <div class="chart-container">
    <div class="chart" id="weekly_combo_chart"></div>
  </div>

  <div class="card-header">
    <input readonly class="form-control" style="color: blue"  value="Monthly Summary">
</div>

  <div class="chart-container">
    <div class="chart" id="monthly_combo_chart"></div>
  </div>
  </div> --}}

  <div id="app">
    <div id="weekly_combo_chart"></div>
    <div id="monthly_combo_chart"></div>

  </div>
  </div>

  <!-- Below element is just for displaying source code. it is not required. DO NOT USE -->
  {{-- <div id="html">
    &lt;div id=&quot;chart&quot;&gt;
      &lt;apexchart type=&quot;line&quot; height=&quot;350&quot; :options=&quot;chartOptions&quot; :series=&quot;series&quot;&gt;&lt;/apexchart&gt;
    &lt;/div&gt;
  </div> --}}


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
    // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
    // Based on https://gist.github.com/blixt/f17b47c62508be59987b
    var _seed = 42;
    Math.random = function() {
      _seed = _seed * 16807 % 2147483647;
      return (_seed - 1) / 2147483646;
    };
  </script>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    drawCharts();
  });

  function drawCharts() {
    drawWeeklyComboChart();
    drawMonthlyComboChart();
  }

  function drawWeeklyComboChart() {
    var weeklyData = <?php echo json_encode($averages); ?>;
    var countries = Object.keys(weeklyData);
    var weekLabels = Object.keys(weeklyData[countries[0]]['weeks']);

    var seriesData = countries.map(country => ({
      name: country,
      type: 'column',
      data: weekLabels.map(week => weeklyData[country]['weeks'][week])
    }));

    var totalSeries = {
      name: 'Total',
      type: 'line',
      data: weekLabels.map(week => countries.reduce((sum, country) => sum + weeklyData[country]['weeks'][week], 0))
    };
    seriesData.push(totalSeries);

    var options = {
      series: seriesData,
      chart: {
        height: 350,
        type: 'line'
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: 'Weekly Totals and Averages'
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [seriesData.length - 1]
      },
      labels: weekLabels.map(week => 'Week ' + week),
      xaxis: {
        type: 'category',
        title: {
          text: 'Week'
        }
      },
      yaxis: {
        title: {
          text: 'Percentage'
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#weekly_combo_chart"), options);
    chart.render();
  }

  function drawMonthlyComboChart() {
    var monthlyData = <?php echo json_encode($averages); ?>;
    var countries = Object.keys(monthlyData);
    var monthLabels = Object.keys(monthlyData[countries[0]]['months']);

    var seriesData = countries.map(country => ({
      name: country,
      type: 'column',
      data: monthLabels.map(month => monthlyData[country]['months'][month])
    }));

    var totalSeries = {
      name: 'Total',
      type: 'line',
      data: monthLabels.map(month => countries.reduce((sum, country) => sum + monthlyData[country]['months'][month], 0))
    };
    seriesData.push(totalSeries);

    var options = {
      series: seriesData,
      chart: {
        height: 350,
        type: 'line'
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: 'Monthly Totals and Averages'
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [seriesData.length - 1]
      },
      labels: monthLabels.map(formatMonthLabel),
      xaxis: {
        type: 'category',
        title: {
          text: 'Month'
        }
      },
      yaxis: {
        title: {
          text: 'Percentage'
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#monthly_combo_chart"), options);
    chart.render();
  }

  function formatMonthLabel(month) {
    var date = new Date(month);
    var monthName = date.toLocaleString('default', { month: 'short' });
    var year = date.getFullYear().toString().substr(-2);
    return monthName + '-' + year;
  }
</script>



@stop
