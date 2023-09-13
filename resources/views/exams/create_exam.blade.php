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
        <input type="hidden" class="form-control" name="created_by" value="{{ Auth::user()->id }}">

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
                    <label>Course</label>
                    <select class="custom-select"id="course" name="course" data-placeholder="select" value="{{ old('course') }}">
                    <option value="" disabled selected>Choose course</option>
                    @foreach ($Course as $row)
                    <option value="{{$row['id']}}">{{$row['course_name']}}</option>
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
                <label for="answer_a">Answer A</label>
                <textarea id="answer_a" name="answer_a" class="form-control" rows="3" placeholder="Enter an answer ..." value="{{ old('answer_a') }}" ></textarea>
                @error('answer_a')
                  <span style="color:red">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label for="question_weight_a">Answer Weight</label>
                <input type="number" id="question_weight_a" name="question_weight_[{{ old('answer_a')}}]" class="form-control" placeholder="Weightage" value="{{ old('question_weight.' . old('answer_a')) }}">
                @error('question_weight.a')
                  <span style="color:red">{{ $message }}</span>
                @enderror
                <div class="form-check mt-2">
                  <input class="form-check-input" type="radio" name="is_correct" value="answer_a" id="is_correct_answer_a" {{ old('is_correct_answer') == 'answer_a' ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_correct_answer_a">
                    Correct Answer
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col">
                <label for="answer_a">Answer B</label>
                <textarea id="answer_b" name="answer_b" class="form-control" rows="3" placeholder="Enter an answer ..." value="{{ old('answer_b') }}" ></textarea>
                @error('answer_a')
                  <span style="color:red">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label for="question_weight_b">Answer Weight</label>
                <input type="number" id="question_weight_b" name="question_weight_[{{ old('answer_b')}}]" class="form-control" placeholder="Weightage" value="{{ old('question_weight.' . old('answer_b')) }}">
                @error('question_weight.b')
                  <span style="color:red">{{ $message }}</span>
                @enderror
                <div class="form-check mt-2">
                  <input class="form-check-input" type="radio" name="is_correct" value="answer_b" id="is_correct_answer_b" {{ old('is_correct_answer') == 'answer_b' ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_correct_answer_a">
                    Correct Answer
                  </label>
                </div>
              </div>
            </div>
          </div>


          <div class="card-body">
            <div class="row">
              <div class="col">
                <label for="answer_a">Answer C</label>
                <textarea id="answer_c" name="answer_c" class="form-control" rows="3" placeholder="Enter an answer ..." value="{{ old('answer_c') }}" ></textarea>
                @error('answer_a')
                  <span style="color:red">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label for="question_weight_c">Answer Weight</label>
                <input type="number" id="question_weight_c" name="question_weight_[{{ old('answer_c')}}]" class="form-control" placeholder="Weightage" value="{{ old('question_weight.' . old('answer_c')) }}">
                @error('question_weight.c')
                  <span style="color:red">{{ $message }}</span>
                @enderror
                <div class="form-check mt-2">
                  <input class="form-check-input" type="radio" name="is_correct" value="answer_c" id="is_correct_answer_c" {{ old('is_correct_answer') == 'answer_c' ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_correct_answer_c">
                    Correct Answer
                  </label>
                </div>
              </div>
            </div>
          </div>


          <div class="card-body">
            <div class="row">
              <div class="col">
                <label for="answer_a">Answer D</label>
                <textarea id="answer_d" name="answer_d" class="form-control" rows="3" placeholder="Enter an answer ..." value="{{ old('answer_d') }}" ></textarea>
                @error('answer_a')
                  <span style="color:red">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label for="question_weight_d">Answer Weight</label>
                <input type="number" id="question_weight_d" name="question_weight_[{{ old('answer_d')}}]" class="form-control" placeholder="Weightage" value="{{ old('question_weight.' . old('answer_d')) }}">
                @error('question_weight.c')
                  <span style="color:red">{{ $message }}</span>
                @enderror
                <div class="form-check mt-2">
                  <input class="form-check-input" type="radio" name="is_correct" value="answer_d" id="is_correct_answer_d" {{ old('is_correct_answer') == 'answer_d' ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_correct_answer_d">
                    Correct Answer
                  </label>
                </div>
              </div>
            </div>
          </div>

    </div>
        <div class="card-footer">
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
