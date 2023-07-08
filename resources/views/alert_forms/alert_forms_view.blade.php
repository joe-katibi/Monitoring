@extends('adminlte::page')

@section('title', 'Alert-Form-Results')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')

<div class="card card-success ">
        <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Alert Forms">
        </div>
             <div class="card-body">
              <form method="" action="{{ route('final_show_view.show') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
        <div class="row">
            <div class="col-md-2">
                <label for="section">Select Category</label>
                <div class="form-group">
                   <select class="form-control" required="required" id="category" name="category"><option selected="selected" value="">--Select Category--</option>
                    @foreach ($category as $categorys)
                    <option value="{{ $categorys['id'] }}">{{$categorys['category_name'] }}</option>
                    @endforeach
                </select>
                </div>
                </div>
                <div class="col-md-2">
                    <label for="section">Select Agent</label>
                    <div class="form-group">
                       <select class="form-control" required="required" id="agent" name="agent"><option selected="selected" value="">--Select Agent--</option>
                        {{-- @foreach ($agents as $agent)
                        <option value="{{ $agent['id'] }}">{{$agent['name'] }}</option>
                        @endforeach --}}
                    </select>
                    </div>
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
                     <input type="text" name="created_at" class="form-control daterange" id="reservation">
                   </div>
                  <!-- /.input group -->
             </div>
            </div>
          </div>
          @can('view-results-autofail-button')
      <div class="col">
        <button type="submit" class="btn btn-success float-right" ><strong>Search</strong></button>
     </div>
     @endcan
   </form>
  </div>
</div>
<div class="card">
  <div class="card-body">
    @if ($categorys['id'] > 0)
    <table class="table table-bordered" id="questionsTable">
        <thead>
         <tr>
            <th>Agent:</th>
            <th>Supervisor:</th>
            <th>QA:</th>
            <th>Problem Description</th>
            <th>Fatal Error Committed</th>
            <th>Supervisor Comments</th>
            <th>Date signed QA</th>
            <th>Date signed Supervisor</th>
            <th>Date signed Agent</th>
            <th>Status</th>
           <th>Action</th>
          </tr>
         </thead>
   <tbody>
   @foreach($viewalert as $row)
       <tr>

             <td>{{ $row['agentName'] }}</td>
             <td>{{ $row['SupervisorName'] }}</td>
             <td>{{ $row['qualityName'] }}</td>
             <td>{{ $row['description'] }}</td>
             <td>{{ $row['fatal_error'] }}</td>
             <td>{{ $row['supervisor_comment'] }}</td>
             <td>{{ $row['date_by_qa'] }}</td>
             <td>{{ $row['date_by_supervisor'] }}</td>
             <td>{{ $row['date_by_agent'] }}</td>
             <td>

                @switch($row['auto_status'] )
                    @case($row['auto_status']  == '3')
                    <a disable class="badge badge-success" >Completed</a>
                        @break
                    @case($row['auto_status']  == '2')
                    <a disable class="badge badge-warning" >pending</a>
                        @break
                    @case($row['auto_status']  == '1')
                    <a disable class="badge badge-danger" >Slipping</a>
                        @break

                    @default

                @endswitch

            </td>
             <td class="text-right" >
                @can('view-results-autofail-button-view')
               <div class="btn-group btn-group-sm">
                <a href="{{ route('autofail.edit',$row['id'] ) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                <a href="{{ route('autofail.show',$row['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
               </div>
               @endcan
             </td>
          </tr>
          @endforeach
    </tbody>
</table>

    @else
    <p>No results found.</p>
    @endif

  </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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

<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Crm Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#agent").html('');
            $.ajax({
                url: '/category/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#agent').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#agent").append('<option value="' + value
                            .user_id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>




@stop
