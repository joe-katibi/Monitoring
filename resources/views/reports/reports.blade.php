@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="card card-success ">
    <div class="card-header">
         <input readonly class="form-control" style="color: green" name="category" value=" QA Reports">
        </div>
      <div class="card-body">
            <!-- Content Starts -->
            <div class="row justify-content-center">
                <div class="col-md-3 col-sm-6">
                   <a href="/reports/global_report" ><div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3> <b>Global</b></h3>
                            <p>All Countries</p>
                        </div>
                    </div></a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="/reports/fiber_reports" > <div class="card  bg-success"  >
                        <div class="card-body text-center" >
                            <h3><b>Fiber</b></h3>
                            <p> All Fiber</p>
                        </div>
                    </div></a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="/reports/dth_report" >   <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>DTH</b></h3>
                            <p>All DTH</p>
                        </div>
                    </div></a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="/reports/team_report" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Team</b></h3>
                            <p>All Teams</p>
                        </div>
                    </div></a>
                </div>

            </div>
             <!-- Content Starts -->
             <div class="row justify-content-center">
                <div class="col-md-3 col-sm-6">
                    <a href="/reports/percentile_report" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Percentile</b></h3>
                            <p>All Percentile</p>
                        </div>
                    </div></a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="/reports/categories_report" >   <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Categories</b></h3>
                            <p>All Categories</p>
                        </div>
                    </div></a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="/reports/productivity" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Productivity</b></h3>
                            <p>All Productivity</p>
                        </div>
                    </div></a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="/reports/auto_fail_report" >  <div class="card  bg-danger">
                        <div class="card-body text-center">
                            <h3><b>Auto Fails</b></h3>
                            <p>Auto Fails</p>
                        </div>
                    </div></a>
                </div>

            </div>
        </div>
    <!-- /Page Wrapper -->
     </div>
     <div class="card card-success ">
     <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value=" Exams Reports">
       </div>
     <div class="card-body">
           <!-- Content Starts -->
           <div class="row justify-content-center">
               <div class="col-md-3 col-sm-6">
                  <a href="/reports/global_report" ><div class="card  bg-success">
                       <div class="card-body text-center">
                           <h3> <b>Global</b></h3>
                           <p>All Countries</p>
                       </div>
                   </div></a>
               </div>
               <div class="col-md-3 col-sm-6">
                   <a href="/reports/fiber_reports" > <div class="card  bg-success"  >
                       <div class="card-body text-center" >
                           <h3><b>Fiber</b></h3>
                           <p> All Fiber</p>
                       </div>
                   </div></a>
               </div>
               <div class="col-md-3 col-sm-6">
                   <a href="/reports/dth_report" >   <div class="card  bg-success">
                       <div class="card-body text-center">
                           <h3><b>DTH</b></h3>
                           <p>All DTH</p>
                       </div>
                   </div></a>
               </div>
               <div class="col-md-3 col-sm-6">
                   <a href="/reports/team_report" >  <div class="card  bg-success">
                       <div class="card-body text-center">
                           <h3><b>Team</b></h3>
                           <p>All Teams</p>
                       </div>
                   </div></a>
               </div>

           </div>
            <!-- Content Starts -->
            <div class="row justify-content-center">
               <div class="col-md-3 col-sm-6">
                   <a href="/reports/percentile_report" >  <div class="card  bg-success">
                       <div class="card-body text-center">
                           <h3><b>Courses</b></h3>
                           <p>All Courses</p>
                       </div>
                   </div></a>
               </div>
               <div class="col-md-3 col-sm-6">
                   <a href="/reports/categories_report" >   <div class="card  bg-success">
                       <div class="card-body text-center">
                           <h3><b>Categories</b></h3>
                           <p>All Categories</p>
                       </div>
                   </div></a>
               </div>
               <div class="col-md-3 col-sm-6">
                   <a href="/reports/productivity" >  <div class="card  bg-success">
                       <div class="card-body text-center">
                           <h3><b>Productivity</b></h3>
                           <p>All Productivity</p>
                       </div>
                   </div></a>
               </div>
           </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
