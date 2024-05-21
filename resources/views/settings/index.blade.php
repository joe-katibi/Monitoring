@extends('adminlte::page')

@section('title', 'Administration Settings | Zuku Monitoring')

@section('content_header')
<h1></i> Administration Settings </h1>
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-cogs"></i> Settings </li>
    
  </ol>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="box box-primary">
          <div class="box-header with-border ">
              <h3 class="box-title"><i class="fa fa-cogs"></i> System Configuration</h3>
          </div>
          <div class="box-body">
              <div class="row top-padder">
                  <div class="col-md-3 col-sm-6 col-xs-12 ">
                      <a class="tile" href="{{ url('settings/maintenance_types') }}">
                          <div class="small-box small-box-bdr">
                              <span class="txt-ctr"><i class="fa fa-list"></i></span>
                              <span class="small-box-footer bg-green-active">Maintenance Types</span>
                          </div>
                      </a>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                      <a class="tile" href="{{ url('settings/assembly') }}">
                          <div class="small-box small-box-bdr">
                              <span class="txt-ctr green"><i class=" fa fa-object-ungroup"></i></span>
                              <span class="small-box-footer bg-green-active">Assembly</span>

                          </div>
                      </a>
                  </div>
                  
                   <div class="col-md-3 col-sm-6 col-xs-12">
                      <a class="tile" href="{{ url('settings/task_types') }}">
                          <div class="small-box small-box-bdr">
                              <span class="txt-ctr green"><i class=" fa fa-tachometer"></i></span>
                              <span class="small-box-footer bg-green-active">Task Types</span>

                          </div>
                      </a>
                  </div>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                      <a class="tile" href="{{ url('settings/ata_chapters') }}">
                          <div class="small-box small-box-bdr">
                              <span class="txt-ctr green"><i class=" fa fa-check-square-o"></i></span>
                              <span class="small-box-footer bg-green-active">Ata Chapters</span>

                          </div>
                      </a>
                  </div> 

              </div>

          </div>
      </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/custom.css">
<style>


</style>
@stop

@section('js')
<script type="text/javascript">
  $(document).ready(function(){

  });

</script>


@stop