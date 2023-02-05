@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<form method="POST" action="" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
    <div class="card card-success ">
        <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Global Reports">
        </div>
        <div class="card-body">
    <div class="col-md-12">
   <label for="section">Select Country</label>
   <div class="form-group">
       <select class="form-control" required="required" id="section" name="section"><option selected="selected" value="">--Select Country--</option>
           <option value="1">Kenya</option>
           <option value="2">Uganda</option>
           <option value="3">Tanzania</option>
           <option value="4">Malawi</option>
           <option value="">Zambia</option>
       </select>
   </div>
   </div>

<div class="col-md-12">
<label for="section">Select service</label>
<div class="form-group">
   <select class="form-control" required="required" id="section" name="section"><option selected="selected" value="">--Select service--</option><option value="1">Fiber</option><option value="2">DTH</option></select>
</div>
</div>

<div class="col-md-12">


   <!-- Date range -->
   <div class="form-group">
    <label>Date range:</label>

    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="far fa-calendar-alt"></i>
        </span>
      </div>
      <input type="text" class="form-control daterange" id="reservation">
    </div>
    <!-- /.input group -->
  </div>



<button type="submit" class="btn btn-info btn-flat pull-right"
   name="submit_filter"><strong>SUBMIT</strong></button>
</div>
</div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


@stop

@section('js')
    <script  src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script  src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script  src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
	$('.daterange').daterangepicker();
</script>

@stop
