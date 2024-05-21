@extends('adminlte::page')

@section('title', 'Results-View | Zuku Monitoring')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<div class="card card-success ">
    <div class="card-header">
         <input readonly class="form-control" style="color: green" name="category" value=" Result">
        </div>
      <div class="card-body">
            <!-- Content Starts -->
            <div class="row justify-content-center">
                @can('view-results-audit-menu')
                <div class="col-md-3 col-sm-6">
                   <a href="{{ route('qaresults.index') }}" ><div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3> <b>Audit Results</b></h3>
                            <p>All Audit Results</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-results-exam-menu')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('examresult.index') }}" > <div class="card  bg-success"  >
                        <div class="card-body text-center" >
                            <h3><b>Exams Results</b></h3>
                            <p> All Exams Results</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-results-autofail-menu')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('final_show_view.index') }}">   <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Auto Fails</b></h3>
                            <p>All Auto Fails</p>
                        </div>
                    </div></a>
                </div>
                @endcan
                @can('view-results-autofail-menu')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('coaching.create') }}">   <div class="card  bg-success">
                        <div class="card-body text-center">
                            <h3><b>Coaching Forms</b></h3>
                            <p>All Coaching Forms</p>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
