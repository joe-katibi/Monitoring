@extends('adminlte::page')

@section('title', 'Audit-Results')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form method="" action="{{ route('qaresults.search') }}" accept-charset="UTF-8" class="form"><input name="_token" type="hidden" value="">
         <div class="card card-success ">
            <div class="card-header">
                 <input readonly class="form-control" style="color: green" value="Audit Results">
                </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="section">Supervisor</label>
                    <select class="form-control" required="required" id="supervisor" name="supervisor"><option selected="selected" value="">--Select Supervisor--</option>
                     @foreach ($qa_results as $supervisor )
                     <option value="{{$supervisor->supervisor}}">{{ $supervisor->SupervisorName }}</option>
                     @endforeach
                   </select>                    {{-- <input readonly class="form-control"  name="supervisor" value="{{ Auth::user()->name }}">
                    <input  type="hidden" class="form-control" name="supervisor" value="{{ Auth::user()->id }}"> --}}
                </div>
            <div class="col-md-4">
               <label for="section">Select Ticket Status</label>
                <div class="form-group">
           <select class="form-control" required="required" id="status" name="status"><option selected="selected" value="">--Select ticket Status--</option>

                   <option value="1">Completed</option>
                   <option value="2">Slipping</option>
                   <option value="3">Pending</option>
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
        @can('view-results-audit-button')
          <div class="col">
            <button type="submit" class="btn btn-success float-right" ><strong>Search</strong></button>
         </div>
         @endcan
        </div>
</form>
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
              <td>
                @foreach ( $row->autofails as $autofail)
                @if ($autofail['results_id'] == $row['id'])
                <a disable class="badge badge-danger" >Auto-fail registered</a>
                @else
                <a disable class="badge badge-success" >No Auto-fail</a>
                @endif

                @endforeach

              </td>


              <td class="text-right" >
                <div class="btn-group btn-group-sm">
                    @can('view-results-audit-edit')
                    <a href="{{ route('qaresults.edit',$row['id']) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
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

@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

@stop

@section('js')

<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script>

<script  src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script  src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script  src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
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




@stop
