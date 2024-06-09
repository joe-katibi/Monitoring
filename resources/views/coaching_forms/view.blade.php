@extends('adminlte::page')

@section('title', 'Alert-Form-Results | Zuku Monitoring')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
@can('supervisor-report-request')
<div class="card card-success ">
    <div class="card-header">
    <input readonly class="form-control" style="color: green" name="category" value="Coaching Forms">
    </div>
         <div class="card-body">
          <form method="" action="{{ route('supervisor') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
    <div class="row">
        <div class="col-md-2">
            <label for="section">Select Category</label>
            <div class="form-group">
               <select class="form-control" required="required" id="category" name="category"><option selected="selected" value="">--Select Category--</option>
                @foreach ($category as $categorys)

                <option value="{{ $categorys['id'] }}">{{$categorys['category_name']}}</option>
                @endforeach
            </select>
            </div>
            </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="section">Supervisor</label>
                <select class="form-control" required="required" id="supervisor1" name="supervisor"><option selected="selected" value="">--Select Supervisor--</option>
                 <option value="{{$userlogged['id']}}">{{ $userlogged['name'] }}</option>
               </select>
            </div>
            </div>
            <div class="col-md-2">
                <label for="section">Select Agent</label>
                <div class="form-group">
                   <select class="form-control" required="required" id="agents" name="agent"><option selected="selected" value="">--Select Agent--</option>
                    @foreach ($agents as $agent)
                    <option value="{{ $agent['id'] }}">{{$agent['name'] }}</option>
                    @endforeach
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
@endcan
@can('quality-analysts-report-request')
<div class="card card-success ">
    <div class="card-header">
    <input readonly class="form-control" style="color: green" name="category" value="Coaching Forms">
    </div>
         <div class="card-body">
          <form method="" action="{{ route('coaching.quality') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
    <div class="row">
        <div class="col-md-2">
            <label for="section">Select service</label>
            <div class="form-group">
               <select class="form-control" required="required" id="service" name="service">
                <option selected="selected" value="">--Select service--</option>
                @foreach ($services as $service)
                <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                @endforeach
            </select>
            </div>
            </div>
            <div class="col-md-2">
                <label for="service[]">Select Category</label>
                <div class="form-group">
                    <select class="form-control" required="required" id="category" name="category">
                        @foreach ($category as $categorys)

                        <option value="{{ $categorys['id'] }}">{{$categorys['category_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="section">Supervisor</label>
                <select class="form-control" required="required" id="supervisor" name="supervisor"><option selected="selected" value="">--Select Supervisor--</option>
                 <option value="{{$userlogged['id']}}">{{ $userlogged['name'] }}</option>
               </select>
            </div>
            </div>
            <div class="col-md-2">
                <label for="section">Select Agent</label>
                <div class="form-group">
                   <select class="form-control" required="required" id="agent" name="agent"><option selected="selected" value="">--Select Agent--</option>
                    @foreach ($agents as $agent)
                    <option value="{{ $agent['id'] }}">{{$agent['name'] }}</option>
                    @endforeach
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
@endcan


    @can('agent-report-request')
<div class="card card-success ">
    <div class="card-header">
    <input readonly class="form-control" style="color: green" name="category" value="Coaching Forms">
    </div>
         <div class="card-body">
          <form method="" action="{{ route('coaching.coach') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
    <div class="row">
        <div class="col-md-2">
            <label for="section">Select Category</label>
            <div class="form-group">
               <select class="form-control" required="required" id="category" name="category"><option selected="selected" value="">--Select Category--</option>
                @foreach ($category as $categorys)

                <option value="{{ $categorys['id'] }}">{{$categorys['category_name']}}</option>
                @endforeach
            </select>
            </div>
            </div>

            <div class="col-md-2">
                <label for="section">Select Agent</label>
                <div class="form-group">
                   <select class="form-control" required="required"  name="agent"><option selected="selected" value="">--Select Agent--</option>
                     @foreach ($agents as $agent)
                    <option value="{{ $agent['id'] }}">{{$agent['name'] }}</option>
                    @endforeach
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
@endcan
<div class="card">
    <div class="card-body">
      @if ($categorys['id'] > 0)
      <table class="table table-bordered" id="questionsTable">
          <thead>
           <tr>
              <th>Agent:</th>
              <th>Supervisor:</th>
              <th>QA:</th>
              <th>Date of Coaching:</th>
              <th>Status:</th>
             <th>Action:</th>
            </tr>
           </thead>
     <tbody>
     @foreach($coachingview as $row)
         <tr>

               <td>{{ $row['agentName'] }}</td>
               <td>{{ $row['SupervisorName'] }}</td>
               <td>{{ $row['qualityName'] }}</td>
               <td>{{ $row['created_at'] }}</td>
               <td>

                  @switch($row['coaching_status'] )
                      @case($row['coaching_status']  == '1')
                      <a disable class="badge badge-danger" >Slipping</a>
                          @break
                      @case($row['coaching_status']  == '2')
                      <a disable class="badge badge-warning" >Pending</a>
                          @break
                      @case($row['coaching_status']  == '3')
                      <a disable class="badge badge-success" >Completed</a>
                          @break
                      @default
                  @endswitch
              </td>
               <td class="text-right" >
                  @can('view-results-autofail-button-view')
                 <div class="btn-group btn-group-sm">
                    @switch($user_id)
                      @case(isset($agentlogged) && $user_id == $agentlogged->model_id)
                      <a href="{{ route('coaching.edit',$row['id'] ) }}" class="btn btn-success" style="display: none;"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('coaching.agentEdit',$row['id'] ) }}" class="btn btn-success" @if ($row['coaching_status'] == 3 || $row['coaching_status'] == 1 || $row['coaching_status'] == 0) style="display: none;" @endif><i class="fas fa-edit"></i></a>

                          @break
                          @case(isset($supervisorlogged) && $user_id == $supervisorlogged->model_id)
                          <a href="{{ route('coaching.edit',$row['id'] ) }}" class="btn btn-success"  @if ($row['coaching_status'] == 3 || $row['coaching_status'] == 2 || $row['coaching_status'] == 0) style="display: none;" @endif><i class="fas fa-edit"></i></a>
                          <a href="{{ route('coaching.agentEdit',$row['id'] ) }}" class="btn btn-success" style="display: none;"><i class="fas fa-edit"></i></a>


                          @break
                          @case(isset($qualitylogged) && $user_id == $qualitylogged->model_id)
                          <a href="{{ route('coaching.edit',$row['id'] ) }}" class="btn btn-success" style="display: none;"><i class="fas fa-edit"></i></a>
                          <a href="{{ route('coaching.agentEdit',$row['id'] ) }}" class="btn btn-success" style="display: none;" ><i class="fas fa-edit"></i></a>

                          @break
                          @case(isset($trainierlogged) && $user_id == $trainierlogged->model_id)
                          <a href="{{ route('coaching.edit',$row['id'] ) }}" class="btn btn-success" style="display: none;"><i class="fas fa-edit"></i></a>
                          <a href="{{ route('coaching.agentEdit',$row['id'] ) }}" class="btn btn-success" style="display: none;" ><i class="fas fa-edit"></i></a>

                          @break

                      @default

                  @endswitch

                  <a href="{{ route('coaching.show', ['coaching' => $row['id'], 'results_id' => $row['results_id']]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>

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

<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Supervisor Coaching Request Agent drop down Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#supervisor1').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#agents").html('');
            $.ajax({
                url: '/categoryliveagent/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#agents').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#agents").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>


<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Service Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#service').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#category").html('');
            $.ajax({
                url: '/auto-fail/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#category').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#category").append('<option value="' + value
                            .id + '">' + value.category_name + '</option>');
                    });

                }
            });
        });

    });
</script>

<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Supervisor Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#supervisor").html('');
            $.ajax({
                url: '/categorylivesupervisor/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#supervisor').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#supervisor").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>



<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Agent drop down Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#agent").html('');
            $.ajax({
                url: '/categoryliveagent/'+qaa_call_category,
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
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>

@stop
