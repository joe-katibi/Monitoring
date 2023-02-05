@extends('adminlte::page')

@section('title', 'conduct Exam')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form>
    <div class="card card-success ">
        <div class="card-header"> <input readonly class="form-control" style="color: green" name="category" value="View Question"></div>
        <div class="card-body"><a href="/exams/exam_bank" class="btn btn-lg btn-success" style="float: right;"> back</a></div>
        <div class="container">
        <div class="card-body float-center ">
                <div class="col-md-12">
                    <label>Question</label>
                    <textarea disabled id="question" name="question" class="form-control float-center" rows="2" >{!! $questions->question !!}</textarea>
                </div>
        </div>
        <div class="card-body float-center">
            <div class="row">
                 <div class="col-md-3">
                    <label>Correct Answer</label>
                    <input readonly name="correct_answer" class="form-control float-center"  value="{!! $questions->answer_key !!}">
                 </div>
                 <div class="col-md-3">
                    <label>Course</label>
                    <input readonly name="correct_answer" class="form-control float-center"  value="{!! $questions->course !!}">
                 </div>
                </div>
        </div>
        <div class="card-body float-center ">
                <div class="col-md-12">
                    <label>Answer A</label>
                    <textarea readonly id="answer_a" name="answer_a" class="form-control float-center" rows="2">{!! $questions->answer_a !!}</textarea>
                </div>
         </div>
       <div class="card-body float-center ">
                <div class="col-md-12">
                    <label>Answer B</label>
                    <textarea readonly  id="answer_b" name="answer_b" class="form-control float-center" rows="2">{!! $questions->answer_b !!}</textarea>
                </div>
       </div>
       <div class="card-body float-center ">
                <div class="col-md-12">
                   <label>Answer C</label>
                   <textarea readonly id="answer_c" name="answer_c" class="form-control float-center" rows="2">{!! $questions->answer_c !!}</textarea>
                </div>
      </div>
      <div class="card-body float-center ">
                <div class="col-md-12">
                  <label>Answer D</label>
                  <textarea readonly id="answer_d"  name="answer_d" class="form-control float-center" rows="2">{{ $questions->answer_d}}</textarea>
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
          height: 100,

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
