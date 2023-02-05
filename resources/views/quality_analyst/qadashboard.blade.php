@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>QA Dashboard</h1>
@stop

@section('content')

     <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>150</h3>
    
                    <p>All Agents</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
    
                    <p>Bounce Rate</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>44</h3>
    
                    <p>User Registrations</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>65</h3>
    
                    <p>Slipping tickects</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pending-actions"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header border-0">
                      <div class="d-flex justify-content-between">
                        <h3 class="card-title">Team Performance</h3>
                        <a href="javascript:void(0);">View Report</a>
                          </div>
                             </div>
                             <div class="card-body">
                                  <div class="d-flex">
                        <p class="d-flex flex-column">
                          <span class="text-bold text-lg">820</span>
                          <span>Visitors Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                          <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 12.5%
                          </span>
                          <span class="text-muted">Since last week</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->
      
                      <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                      </div>
      
                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <i class="fas fa-square text-primary"></i> This Week
                        </span>
      
                        <span>
                          <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                      </div>
                      </div>
                      </div>
                      </div>
                      <!-- /.col-md-6 -->
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Sales</h3>
                      <a href="javascript:void(0);">View Report</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        <span class="text-bold text-lg">$18,230.00</span>
                        <span>Sales Over Time</span>
                      </p>
                      <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                          <i class="fas fa-arrow-up"></i> 33.1%
                        </span>
                        <span class="text-muted">Since last month</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->
    
                    <div class="position-relative mb-4">
                      <canvas id="sales-chart" height="200"></canvas>
                    </div>
    
                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> This year
                      </span>
    
                      <span>
                        <i class="fas fa-square text-gray"></i> Last year
                      </span>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
                    </div>
                    
                     </div>
                     
                    </div>
                    
                </div>
                
             </div>
                </div>
              </div>
               </div>
               
            </div>
        </div>
        </div>
        </div>
      </div>
       </div>
                        <!-- /.card -->
                  
           
                  
                      <!-- ./col -->
                      </div>
                       <!-- /.row -->
                     </div>
                  <!-- /.card-footer -->
                    </div>
                
                  </section>
         
   


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


@stop
