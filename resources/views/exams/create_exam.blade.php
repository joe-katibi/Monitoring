@extends('adminlte::page')

@section('title', 'Create Exam')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('exambank.store') }}" method="POST">
  @csrf
    <div class="card card-success " >
        <div class="card-header"> <input readonly class="form-control" style="color: green" name="category" value="Create"></div>
        <input type="hidden" class="form-control" name="created_by" value="{{ Auth::user()->name }}">

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
                {{-- <div class="col-md-3">
                    <label>Question Weight</label>
                  <input type="number" name="question_weight" class="form-control" placeholder="weightage" value="{{ old('question_weight') }}">
                </div> --}}
                <div class="col-md-3">
                    <label>Course</label>
                    <select class="custom-select"id="course" name="course" data-placeholder="select" value="{{ old('course') }}">
                    <option value="" disabled selected>Choose course</option>
                    @foreach ($Course as $row)
                    <option value="{{$row['id']}}">{{$row['course_name']}}</option>
                    @endforeach
                    </select>
                </div>
                {{-- <div class="col-md-3">
                    <label>Answer Key</label>
                    <select class="custom-select"id="answer_key" name="answer_key" data-placeholder="select" value="{{ old('answer_key') }}">
                        <option value="" disabled selected>Choose answer key</option>
                        @foreach ($answer as $row)
                    <option value="{{$row['id']}}">{{$row['answer_name']}}</option>
                    @endforeach

                    </select>
                </div> --}}
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
              <textarea id="answer_a"  name="answer_a" class="form-control float-center" rows="3" placeholder="Enter an answer ..." value="{{ old('answer_a') }}"></textarea>
              <span style="color:red">@error('answer_a'){{ $message }}@enderror</span>
            </div>
            <div class="col-md-3">
                <label>Answer Weight </label>
              <input type="number" id="answer_a" name="question_weight_[{{ old('answer_a')}}]" class="form-control" placeholder="weightage" value="{{ old('question_weight.' . old('answer_a')) }}" >
              <span style="color:red">@error('question_weight'){{ $message }}@enderror</span>
            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="answer_b">Answer B</label>
                    <textarea id="answer_b" name="answer_b" class="form-control" rows="3" placeholder="Enter an answer ..." value="{{ old('answer_b') }}" ></textarea>
                    @error('answer_b')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="question_weight_b">Answer Weight</label>
                    <input type="number" id="question_weight_b" name="question_weight_[{{ old('answer_b')}}]" class="form-control" placeholder="Weightage" value="{{ old('question_weight.' . old('answer_b')) }}">
                    @error('question_weight.b')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <label>Answer C</label>
              <textarea id="answer_c"  name="answer_c" class="form-control float-center" rows="3" placeholder="Enter an answer ..." value="{{ old('answer_c') }}"></textarea>
              <span style="color:red">@error('answer_c'){{ $message }}@enderror</span>
            </div>
            <div class="col-md-3">
                <label>Answer Weight </label>
              <input type="number" id="answer_c" name="question_weight_[{{ old('answer_c')}}]" class="form-control" placeholder="weightage" value="{{ old('question_weight.' . old('answer_c')) }}">
              <span style="color:red">@error('question_weight'){{ $message }}@enderror</span>
            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <label>Answer D</label>
              <textarea id="answer_d"  name="answer_d" class="form-control float-center" rows="2" placeholder="Enter an answer ..." value="{{ old('answer_d') }}"></textarea>
              <span style="color:red">@error('question'){{ $message }}@enderror</span>
            </div>
            <div class="col-md-3">
                <label>Answer Weight </label>
              <input type="number" id="answer_d" name="question_weight_[{{ old('answer_d')}}]" class="form-control" placeholder="weightage" value="{{ old('question_weight.' . old('answer_d')) }}" >
            </div>
            </div>
        </div>
    </div>
        <div class="card-body">
            @can('view-create-question-button')
            <div class="col">
                <div class="col-md-12">
                <button type="submit" class="btn btn-success float-right">Create Question</button>
            </div>
            </div>
            @endcan
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
