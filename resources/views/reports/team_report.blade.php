@extends('adminlte::page')

@section('title', 'Team Reports | Zuku Monitoring')

@section('content_header')
    <h1>Team Report</h1>
@stop

@section('content') 
    
  
<form method="POST" action="" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">

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
<label for="service[]">Select Team</label>
<div class="form-group">
   <select class="form-control select2 services" required="required" multiple id="service[]" name="service[]"></select>
</div>
</div>
<div class="col-md-12">


<div>
   <label for="from_date">From Date</label>

   <div class="form-group">
       <input class="form-control date" placeholder="Select From Date" autocomplete="off" name="from_date" type="text" value="" id="from_date">
   </div>
</div>

<div>
   <label for="to_date">To Date</label>

   <div class="form-group">
       <input class="form-control date" placeholder="Select To Date" autocomplete="off" name="to_date" type="text" value="" id="to_date">
   </div>
</div>



<button type="submit" class="btn btn-info btn-flat pull-right"
   name="submit_filter"><strong>SUBMIT</strong></button>


</form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="vendor/js/bootstrap-datepicker.min.js"></script>
    <script> 
    
    $(function () {
//Initialize Select2 Elements
$('.select2').select2()
 $('.date').datepicker( { 
     format: 'dd-mm-yyyy',
     autoclose: true,
     orientation: "bottom auto"
 })})

    
    
    
    </script>
@stop