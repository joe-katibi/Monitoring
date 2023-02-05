@extends('adminlte::page')

@section('title', 'Create Exam')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form action="{{ route('exambank.store') }}" method="POST">
  @csrf
    <div class="card card-success " >
        <div class="card-header"> <input readonly class="form-control" style="color: green" name="category" value="Create"></div>

        <div class="card-body ">
            <div class="row">
                 <div class="col-md-3">
                     <label>Service</label>
                     <select class="custom-select"id="service" name="service" data-placeholder="select" value="{{ old('service') }}">
                      <option value="" disabled selected>Select a service</option>
                      @foreach ($service as $row)
                      <option value="{{$row['id']}}">{{$row['service_name']}}</option>
                      @endforeach
                      </select>
                     </div>
                <div class="col-md-3">
                    <label>Question Weight</label>
                  <input type="number" name="question_weight" class="form-control" placeholder="weightage" value="{{ old('question_weight') }}">
                </div>
                <div class="col-md-3">
                    <label>Course</label>
                    <select class="custom-select"id="course" name="course" data-placeholder="select" value="{{ old('course') }}">
                    <option value="" disabled selected>Choose course</option>
                    @foreach ($Course as $row)
                    <option value="{{$row['id']}}">{{$row['course_name']}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Answer Key</label>
                    <select class="custom-select"id="answer_key" name="answer_key" data-placeholder="select" value="{{ old('answer_key') }}">
                        <option value="" disabled selected>Choose answer key</option>
                        @foreach ($answer as $row)
                    <option value="{{$row['id']}}">{{$row['answer_name']}}</option>
                    @endforeach

                    </select>
                </div>
            </div>

        </div>
        <div class="container">
        <div class="card-body">
            <div class="row">
                <div class="col">
                <label>Question</label>
              <textarea id="question"  name="question" class="form-control float-center" rows="3" placeholder="Enter a question ..."></textarea>
              <span style="color:red">@error('question'){{ $message }}@enderror</span>
            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <label>Answer A</label>
              <textarea id="answer_a"  name="answer_a" class="form-control float-center" rows="3" placeholder="Enter an answer ..."></textarea>
              <span style="color:red">@error('question'){{ $message }}@enderror</span>
            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <label>Answer B</label>
              <textarea id="answer_b"  name="answer_b" class="form-control float-center" rows="3" placeholder="Enter an answer ..."></textarea>
              <span style="color:red">@error('question'){{ $message }}@enderror</span>
            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <label>Answer C</label>
              <textarea id="answer_c"  name="answer_c" class="form-control float-center" rows="3" placeholder="Enter an answer ..."></textarea>
              <span style="color:red">@error('question'){{ $message }}@enderror</span>
            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <label>Answer D</label>
              <textarea id="answer_d"  name="answer_d" class="form-control float-center" rows="2" placeholder="Enter an answer ..."></textarea>
              <span style="color:red">@error('question'){{ $message }}@enderror</span>
            </div>
            </div>
        </div>
    </div>
        <div class="card-body">
            <div class="col">
                <div class="col-md-12">
                <button type="submit" class="btn btn-success float-right">Create Question</button>
            </div>
            </div>
        </div>
    </div>
</form>



@stop

@section('css')

@stop

@section('js')


<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
      <script>
        $('#question').summernote({
          placeholder: 'Enter Question',
          tabsize: 2,
          height: 100
        });
        $('#answer_a').summernote({
          placeholder: 'Enter Answer',
          tabsize: 2,
          height: 100
        });
        $('#answer_b').summernote({
          placeholder: 'Enter Answer',
          tabsize: 2,
          height: 100
        });
        $('#answer_c').summernote({
          placeholder: 'Enter Answer',
          tabsize: 2,
          height: 100
        });
        $('#answer_d').summernote({
          placeholder: 'Enter Answer',
          tabsize: 2,
          height: 100
        });
      </script>
@stop
