@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form method="POST" action="" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
    <div class="card card-success ">
       <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Agent Results">
           </div>
   <div class="card-body">
       <div class="row">
       <div class="col-md-6">
          <label for="section">Select Ticket Status</label>
           <div class="form-group">
      <select class="form-control" required="required" id="section" name="section"><option selected="selected" value="">--Select ticket Status--</option>
              <option value="1">Completed</option>
              <option value="2">Slipping</option>
              <option value="3">Pending</option>
         </select>
       </div>
     </div>
    <div class="col-md-6">
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
   </div>
   </div>
     <div class="col">
       <button type="submit" class="btn btn-success float-right" name="submit_filter"><strong>Search</strong></button>
    </div>
   </div>
</form>
<div class="card-body">
<table class="table table-bordered" id="questionsTable">
 <thead>
   <tr>
     <th>Agent Name</th>
     <th>Team Leader Name</th>
     <th>QA Name</th>
     <th>Country</th>
     <th>Service</th>
     <th>Subscriber Code</th>
     <th>Recording ID</th>
     <th>Percentage</th>
     <th>Ticket Status</th>
     <th>Alert Form</th>
     <th>Action</th>
   </tr>
 </thead>
 <tbody>
   <tr>
         <td>joe</td>
         <td>Jon</td>
         <td>Libuli</td>
         <td>Kenya</td>
         <td>Fiber</td>
         <td>00001</td>
         <td>000001</td>
         <td>98%</td>
         <td>Completed</td>
         <td>NO</td>


         <td class="text-right" >
           <div class="btn-group btn-group-sm">
                 <a href="/team_leader/Teamleader_action_results" class="btn btn-success"><i class="fas fa-edit"></i></a>
                 <a href="/team_leader/teamleader_view_results" class="btn btn-info"><i class="fas fa-eye"></i></a>

                  </div>
                </td>

   </tr>

 </tbody>
</table>
</div>


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
<script>

<script  src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
	$('.daterange').daterangepicker(
    {
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY/MM/DD hh:mm:ss '
      }
    }


    );
</script>
  <script type="text/javascript">
	$('.daterange').daterangepicker();
</script>

@stop
