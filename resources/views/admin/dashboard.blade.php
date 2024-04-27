@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green"  value="Trainer Dashboard">
    </div>

 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="card-header">
            <input readonly class="form-control" style="color: green" value="Exams">
           </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $examTotalDone }}</h3>
                <p>Total Exams done</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $courseTotal }}</h3>
                <p>Total Courses </p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $totalExams }}</h3>
                <p>All Exams</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $totalQuestions }}</h3>

                <p>All Questions</p>
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

  </div>

    </section>
    <!-- /.content -->
  </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
     <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
@stop
