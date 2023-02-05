@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden>Scheduled</h1>
@stop

@section('content')
<form action="{{ route('conductexam.store') }}" method="POST">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category_name" value="Schedule Exams">
        </div>
        <div class="container-fluid p-4">
            <div class="row jusify-content-md-center">
                <div class="row">
                         <div class="col-sm-6">
                           <div class="card-body">
                                 <label for="">Course</label>
                                 <select class="custom-select" placeholder="course" id="course" name="course" value="{{ old('course') }}">
                                    <span style="color:red">@error('course'){{ $message }}@enderror</span>
                                    <option disabled selected>select a course</option>
                                    @foreach($course as $row )
                                    <option value="{{ $row['id'] }}">{{$row['course_name']}}</option>
                                    @endforeach
                                  </select>
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-body">
                                  <label for="">Time</label>
                                  <input type="time" class="form-control" name="time" placeholder="time" value="{{ old('time') }}">
                                  <span style="color:red">@error('time'){{ $message }}@enderror</span>
                            </div>
                         </div>

                    <div class="col-sm-6">
                        <div class="card-body">
                             <label for="">Exam name</label>
                             <input type="text" class="form-control" name="exam_name" placeholder="Exam name" value="{{ old('exam_name') }}">
                             <span style="color:red">@error('exam_name'){{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="card-body">
                             <label for="">Services</label>
                             <select class="custom-select" placeholder="service" id="service" name="service" value="{{ old('service') }}">
                                <span style="color:red">@error('service'){{ $message }}@enderror</span>
                                <option disabled selected>select a service</option>
                                @foreach($service as $row )
                                <option value="{{ $row['id'] }}">{{$row['service_name']}}</option>
                                @endforeach
                              </select>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="card-body">
                             <label for="">Category</label>
                            <select class="custom-select" placeholder="category" id="category" name="category" value="{{ old('category') }}">
                                <span style="color:red">@error('category'){{ $message }}@enderror</span>
                                <option disabled selected>select a category</option>
                                @foreach($category as $row )
                                <option value="{{ $row['id'] }}">{{$row['category_name']}}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-body">
                            <label for="">Trainer/QA</label>
                            <select class="custom-select" placeholder="trainer_qa" id="trainer_qa" name="trainer_qa" value="{{ old('trainer_qa') }}">
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
                                    <input type="date" class="form-control" name="start_date" placeholder="start_date" value="{{ old('start_date') }}">
                                    <span style="color:red">@error('start_date'){{ $message }}@enderror</span>
                                 </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="card-body">
                                    <label>Date of completion</label>
                                    <input type="date" class="form-control" name="completion_date" placeholder="completion_date" value="{{ old('completion_date') }}">
                                 <span style="color:red">@error('completion_date'){{ $message }}@enderror</span>
                              </div>
                            </div>
                      </div>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-right">Schedule Exam</button>
                            </div>
                        </div>
                    </div>
     </div>
</form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
