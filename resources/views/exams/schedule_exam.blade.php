@extends('adminlte::page')

@section('title', 'Schedule Exam | Zuku Monitoring')

@section('content_header')
    <h1 hidden>Scheduled</h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('conductexam.store') }}" method="POST">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green"  value="Schedule Exams">
            <input type="hidden" class="form-control" name="created_by" style="color: green"  value="{{ Auth::user()->id }}">
        </div>
        <div class="container-fluid p-4">
            <div class="row jusify-content-md-center">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-body">
                            <label for="">Services</label>
                                <select class="form-control" required="required" id="service" name="service">
                                 <option selected="selected" value="">--Select service--</option>
                                 @foreach ($service as $service)
                                 <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                                 @endforeach
                             </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-body">
                            <label for="">Category</label>
                                <select class="form-control" required="required" id="category" name="category">
                                    <option  value="">--Select Category--</option>
                                </select>
                       </div>
                   </div>
                         <div class="col-sm-6">
                           <div class="card-body">
                                 <label for="">Course</label>
                                 <select class="form-control" required="required" id="course" name="course">
                                 <option selected="selected" value="">--Select Course--</option>
                                 </select>
                                  <span style="color:red">@error('course'){{ $message }}@enderror</span>
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-body">
                                  <label for="duration">Duration</label>
                                  <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="duration" name="time" placeholder="Enter duration" value="{{ old('time') }}">
                                        <span style="color:red">@error('time'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="duration_unit" name="duration_unit">
                                            <option value="hours">Hours</option>
                                            <option value="minutes">Minutes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                         </div>
                    <div class="col-sm-6">
                        <div class="card-body">
                             <label for="">Exam name</label>
                             <input type="text" class="form-control" required name="exam_name" placeholder="Exam name" value="{{ old('exam_name') }}">
                             <span style="color:red">@error('exam_name'){{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-body">
                            <label for="">Trainer/QA</label>
                            <select class="custom-select" placeholder="trainer_qa" required id="trainer_qa" name="trainer_qa" value="{{ old('trainer_qa') }}">
                                <span style="color:red">@error('trainer_qa'){{ $message }}@enderror</span>
                                <option disabled selected>select a Trainer</option>
                                @foreach($trainer as $row )
                                <option value="{{$row->id }}">{{$row->name }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>

                        <div class="col-sm-6">
                             <div class="card-body">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" required name="start_date" placeholder="start_date" value="{{ old('start_date') }}">
                                    <span style="color:red">@error('start_date'){{ $message }}@enderror</span>
                                 </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="card-body">
                                    <label>Date of completion</label>
                                    <input type="date" class="form-control" required name="completion_date" placeholder="completion_date" value="{{ old('completion_date') }}">
                                 <span style="color:red">@error('completion_date'){{ $message }}@enderror</span>
                              </div>
                            </div>
                      </div>
                    </div>
                </div>
                    <div class="card-footer">
                        @can('view-scheduling-exam-button')

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-right">Schedule Exam</button>
                            </div>
                        </div>

                        @endcan
                    </div>
     </div>
</form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var timeInput = document.getElementById('timeInput');
        var timeInMinutesInput = document.getElementById('timeInMinutes');

        // Update the hidden input when the time input changes
        timeInput.addEventListener('input', function () {
            var timeValue = timeInput.value;

            // Convert time to minutes (hh:mm to minutes)
            var parts = timeValue.split(':');
            var hours = parseInt(parts[0], 10) || 0;
            var minutes = parseInt(parts[1], 10) || 0;
            var totalMinutes = hours * 60 + minutes;

            // Update the hidden input with the total minutes
            timeInMinutesInput.value = totalMinutes;
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
            $("#course").html('');
            $.ajax({
                url: '/course-report/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#course').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#course").append('<option value="' + value
                            .id + '">' + value.course_name + '</option>');
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
        $('#course').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#exam").html('');
            $.ajax({
                url: '/course-exam/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#exam').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#exam").append('<option value="' + value
                            .id + '">' + value.exam_name + '</option>');
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

@stop
