@extends('adminlte::page')

@section('title', 'Audit-Results | Zuku Monitoring')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')

@can('supervisor-report-request')
<div class="card card-success ">
    <div class="card-header">
         <input readonly class="form-control" style="color: green" value="Audit Results">
        </div>
<form method="GET" action="{{ route('qaresults.create') }}" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="section">Supervisor</label>
                    <select class="form-control" required="required" id="supervisor" name="supervisor"><option selected="selected" value="">--Select Supervisor--</option>
                     <option value="{{$userlogged['id']}}">{{ $userlogged['name'] }}</option>
                   </select>
                </div>
            <div class="col-md-4">
               <label for="section">Select Ticket Status</label>
                <div class="form-group">
           <select class="form-control" required="required" id="status" name="status"><option selected="selected" value="">--Select ticket Status--</option>
                @foreach ($ticketStatus as $tickets )
                <option value="{{ $tickets['id'] }}">{{ $tickets['status_name']}}</option>
                @endforeach
              </select>
            </div>
          </div>
         <div class="col-md-4">
           <!-- Date range -->
          <div class="form-group">
              <label>Date range:</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
           </div>
           <input type="text" name="created_at"class="form-control daterange" id="reservation">
           </div>
    <!-- /.input group -->
          </div>
        </div>
        </div>
          <div class="col">
            <button type="submit" class="btn btn-success float-right" ><strong>Search</strong></button>
         </div>

        </div>
</form>
</div>
@endcan

@can('agent-report-request')
<div class="card card-success ">
    <div class="card-header">
         <input readonly class="form-control" style="color: green" value="Audit Results">
        </div>
<form method="GET" action="{{ route('qaresults.qualityreport') }}" >
   <div class="card-body">
       <div class="row">
           <div class="col-md-4">
               <label for="section">Agent</label>
               <select class="form-control" required="required" id="agent" name="agent"><option selected="selected" value="">--Select Agent--</option>
                <option value="{{$userlogged['id']}}">{{ $userlogged['name'] }}</option>
              </select>
           </div>
       <div class="col-md-4">
          <label for="section">Select Ticket Status</label>
           <div class="form-group">
      <select class="form-control" required="required" id="status" name="status"><option selected="selected" value="">--Select ticket Status--</option>
           @foreach ($ticketStatus as $tickets )
           <option value="{{ $tickets['id'] }}">{{ $tickets['status_name']}}</option>
           @endforeach
         </select>
       </div>
     </div>
    <div class="col-md-4">
      <!-- Date range -->
     <div class="form-group">
         <label>Date range:</label>
          <div class="input-group">
            <div class="input-group-prepend">
             <span class="input-group-text">
               <i class="far fa-calendar-alt"></i>
             </span>
      </div>
      <input type="text" name="created_at"class="form-control daterange" id="reservation">
      </div>
<!-- /.input group -->
     </div>
   </div>
   </div>
     <div class="col">
       <button type="submit" class="btn btn-success float-right" ><strong>Search</strong></button>
    </div>
   </div>
</form>
</div>
@endcan

@can('quality-analysts-report-request')
<div class="card card-success ">
    <div class="card-header">
         <input readonly class="form-control" style="color: green" value="Audit Results">
        </div>
<form method="GET" action="{{ route('qareport') }}" >
   <div class="card-body">
       <div class="row">
           <div class="col-md-4">
               <label for="section">Quality Analysts</label>
               <select class="form-control" required="required" id="quality" name="quality"><option selected="selected" value="">--Select Quality Analysts--</option>
                <option value="{{$userlogged['id']}}">{{ $userlogged['name'] }}</option>
              </select>
           </div>
       <div class="col-md-4">
          <label for="section">Select Ticket Status</label>
           <div class="form-group">
      <select class="form-control" required="required" id="status" name="status"><option selected="selected" value="">--Select ticket Status--</option>
           @foreach ($ticketStatus as $tickets )
           <option value="{{ $tickets['id'] }}">{{ $tickets['status_name']}}</option>
           @endforeach
         </select>
       </div>
     </div>
    <div class="col-md-4">
      <!-- Date range -->
     <div class="form-group">
         <label>Date range:</label>
          <div class="input-group">
            <div class="input-group-prepend">
             <span class="input-group-text">
               <i class="far fa-calendar-alt"></i>
             </span>
      </div>
      <input type="text" name="created_at"class="form-control daterange" id="reservation">
      </div>
<!-- /.input group -->
     </div>
   </div>
   </div>
     <div class="col">
       <button type="submit" class="btn btn-success float-right" ><strong>Search</strong></button>
    </div>
   </div>
</form>
</div>
@endcan
@can('trainer-report-request')
<div class="card card-success ">
    <div class="card-header">
         <input readonly class="form-control" style="color: green" value="Audit Results">
        </div>
<form method="GET" action="{{ route('qareport') }}" >
   <div class="card-body">
       <div class="row">
           <div class="col-md-4">
               <label for="section">Quality Analysts</label>
               <select class="form-control" required="required" id="quality" name="quality"><option selected="selected" value="">--Select Quality Analysts--</option>
                <option value="{{$userlogged['id']}}">{{ $userlogged['name'] }}</option>
              </select>
           </div>
       <div class="col-md-4">
          <label for="section">Select Ticket Status</label>
           <div class="form-group">
      <select class="form-control" required="required" id="status" name="status"><option selected="selected" value="">--Select ticket Status--</option>
           @foreach ($ticketStatus as $tickets )
           <option value="{{ $tickets['id'] }}">{{ $tickets['status_name']}}</option>
           @endforeach
         </select>
       </div>
     </div>
    <div class="col-md-4">
      <!-- Date range -->
     <div class="form-group">
         <label>Date range:</label>
          <div class="input-group">
            <div class="input-group-prepend">
             <span class="input-group-text">
               <i class="far fa-calendar-alt"></i>
             </span>
      </div>
      <input type="text" name="created_at"class="form-control daterange" id="reservation">
      </div>
<!-- /.input group -->
     </div>
   </div>
   </div>
     <div class="col">
       <button type="submit" class="btn btn-success float-right" ><strong>Search</strong></button>
    </div>
</div>
</form>
</div>
@endcan
<div class="card">
<div class="card-body">
    <table class="table table-bordered" id="questionsTable">
      <thead>
        <tr>
          <th>Agent</th>
          <th>Team Leader </th>
          <th>QA</th>
          <th>Country</th>
          <th>Service</th>
          <th>Subscriber Code</th>
          <th>Recording ID</th>
          <th>Percentage</th>
          <th>Ticket Status</th>
          <th>Date</th>
          <th>Alert Form</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $qa_results as $row )


        <tr>
              <td>{{ $row['agentName'] }}</td>
              <td>{{ $row['SupervisorName'] }}</td>
              <td>{{ $row['qualityName'] }}</td>
              <td>{{ $row['country_name'] }}</td>
              <td>

                @if ($row['service_name']  == 'Cable')
                <a disable class="badge badge-success" >Cable</a>
                @else
                <a disable class="badge badge-primary" >DTH</a>
                @endif


            </td>
              <td>{{ $row['customer_account'] }}</td>
              <td>{{ $row['recording_id'] }}</td>
              <td>{{ $row['final_results'] }}%</td>
              <td>

                @switch($row['status'] )
                    @case($row['status']  == '3')
                    <a disable class="badge badge-success" >Completed</a>
                        @break
                    @case($row['status']  == '2')
                    <a disable class="badge badge-warning" >pending</a>
                        @break
                    @case($row['status']  == '1')
                    <a disable class="badge badge-danger" >Slipping</a>
                        @break

                    @default

                @endswitch

            </td>
            <td>{{ $row['created_at'] }}</td>
              <td>
                @foreach ( $row->autofails as $autofail)
                @if ($autofail['results_id'] === $row['id'])
                <a disable class="badge badge-danger" >Auto-fail registered</a>
                @else
                <a disable class="badge badge-success" >No Auto-fail</a>
                @endif

                @endforeach

              </td>


              <td class="text-right" >
                <div class="btn-group btn-group-sm">
                    @can('view-results-audit-edit')
                    @if($row['status'] == 3)
                    <a style="display:none;"  href="{{ route('qaresults.edit',$row['id']) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>

                    @else
                    <a  href="{{ route('qaresults.edit',$row['id']) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                    @endif
                    @endcan
                     @can('view-results-audit-delete')
                     <a href="{{ route('qaresults.show',$row['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                     @endcan
                       </div>
                     </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link href="/assets/css/dataTables.min.css" rel="stylesheet">
<link href="/assets/css/buttons.bootstrap4.min.css" rel="stylesheet">

@stop

@section('js')
<script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script src="/assets/js/dataTables.min.js"></script>
<script src="/assets/js/pdfmake.min.js"></script>
<script src="/assets/js/vfs_fonts.js"></script>
<script src="/assets/js/buttons.print.min.js"></script>
<script src="/assets/js/buttons.colVis.js"></script>
<script src="/assets/js/buttons.html5.js"></script>
<script src="/assets/js/buttons.jszip.min.js"></script>

<script>
    $(document).ready(function() {
        $('.daterange').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY/MM/DD hh:mm:ss'
            }
        });

        $('#questionsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]

        });

    });
</script>


@stop
