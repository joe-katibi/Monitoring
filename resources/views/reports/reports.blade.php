@extends('adminlte::page')

@section('title', 'Reports | Zuku Monitoring')

@section('content_header')
<h1 hidden>Reports</h1>
@stop

@section('content')
<div class="card card-success ">
    <div class="card-header">
         <input readonly class="form-control" style="color: green" name="category" value=" Reports">
        </div>
      <div class="card-body">
            <!-- Content Starts -->
            <div class="row justify-content-center">
                @can('view-global-reports')
                <div class="col-md-3 col-sm-6">
                   <a href="{{ route('global.index') }}" ><div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3> <b>Global</b></h3>
                            <p>All Countries</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-service-reports')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('servicereport.index') }}" > <div class="card  bg-success"  >
                        <div class="card-body text-center" >
                            <h3><b>Services</b></h3>
                            <p> All Services</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-productivity-reports')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('productivity.index') }}">   <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Productivity</b></h3>
                            <p>All Productivity</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-percentile-reports')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('percentile.index') }}" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Percentile</b></h3>
                            <p>All Percentile</p>
                        </div>
                    </div></a>
                </div>
                @endcan
            </div>
             <!-- Content Starts -->
             <div class="row justify-content-center">
                @can('view-autofail-reports')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('autofailreport.index') }}" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Auto Fails</b></h3>
                            <p>Auto Fails</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-category-reports')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('categories_report.index') }}" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Categories</b></h3>
                           <p>All Categories</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-course-report')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('course_report.index') }}" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Courses</b></h3>
                           <p>All courses</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-livecall-report')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('livecallsreport.index') }}" >  <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Quality Productivity</b></h3>
                           <p>Quality Productivity</p>
                        </div>
                    </div></a>
                </div>
                @endcan

            </div>
        </div>
    <!-- /Page Wrapper -->
     </div>

@stop

@section('css')

@stop

@section('js')

@stop
