@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')

<div class="card card-success ">
        <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Alert Forms">
        </div>
             <div class="card-body">
              <form method="POST" action="" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
        <div class="row">
               <div class="col-md-3">
                  <label>Agent</label>
                  <input type="text" class="form-control" placeholder="Agent">
               </div>
               <div class="col-3">
                   <label>Select</label>
                 <input disabled type="text" class="form-control" Value="Alert Form"placeholder="Alert Form">
               </div>
        <div class="col-md-3">
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
   </form>
  </div>
</div>
<div class="card">
  <div class="card-body">
         <table class="table table-bordered" id="questionsTable">
                <thead>
                 <tr>
                    <th>Agent:</th>
                    <th>Supervisor:</th>
                    <th>QA:</th>
                    <th>Description of the Problem:</th>
                    <th>Fatal Error Committed:</th>
                    <th>Comments by the Supervisor:</th>
                    <th>Date signed by QA:</th>
                    <th>Date signed by Supervisor:</th>
                    <th>Date signed by Agent:</th>
                   <th>Action</th>
                  </tr>
                 </thead>
           <tbody>
               <tr>
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
                      <a href="/alert_forms/alert_view_full" class="btn btn-success"><i class="fas fa-eye"></i></a>
                       </div>
                     </td>
                  </tr>
            </tbody>
    </table>
  </div>
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
<script type="text/javascript">
	$('.daterange').daterangepicker();
</script>

<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script>


@stop
