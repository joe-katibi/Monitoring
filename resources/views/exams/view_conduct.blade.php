@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden>View Conduct</h1>
@stop

@section('content')
@include('sweetalert::alert')
<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="View Scheduled Exams">
        </div>
    <div class="card-body ">
        <div class="row">
             <div class="col-md-2">
                 <label>Exam Name</label>
                 <input readonly type="text" name="exam_name" class="form-control" placeholder="exam_name" value="{{ $viewquestion['exam_name']}}">
                 </div>
            <div class="col-md-2">
                <label>Exam Code</label>
              <input readonly type="text" name="exam_code" class="form-control" placeholder="exam_code" value="{{ $viewquestion->schedule_id }}">
            </div>
            <div class="col-md-2">
                <label>Course</label>
                <input readonly type="text" name="course" class="form-control" placeholder="course" value="{{ $viewquestion->course_name}}">
            </div>
            <div class="col-md-2">
                <label>Trainer/QA</label>
                <input readonly type="text" name="trainer_qa" class="form-control" placeholder="trainer_qa" value="{{$viewquestion->name }}">
            </div>
            <div class="col-md-2">
                <label>Department</label>
                <input readonly type="text" name="department" class="form-control" placeholder="department" value="{{ $viewquestion->category_name }}">
            </div>
            <div class="col-md-2">
                <label>Status</label>
                <input readonly type="text" name="status" class="form-control" placeholder="status" value="{{ $viewquestion->status }}">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card body">
        <div class="row">
            <div class="col-6">
                <label>Date Started</label>
                <input readonly type="text" name="date_start" class="form-control" placeholder="date_start" value="{{ $viewquestion->start_date }}">
                </div>
           <div class="col-6">
               <label>Date Completion</label>
             <input readonly type="text" name="date_completion" class="form-control" placeholder="date_completion" value="{{  $viewquestion->completion_date }}">
           </div>
        </div>
    </div>
</div>
</div>
<div class="card body">
    <div class="card-header">
        {{-- <input readonly class="form-control" style="color: green" name="category" value="Questions"> --}}
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="questionsTable">
            <thead>
            <tr>
                <th>Questions</th>
                <th>Answer</th>
                <th>Marks</th>
              </tr>
            </thead>
              <tbody>
                {{-- @foreach ($viewquestion as $key=>$item) --}}
                <tr>
                    <td >{!! $viewquestion->question !!}</td>
                    <td>
                        <ol type="A" >
                        <li>{!! $viewquestion->answer_a !!}</li>
                        <li>{!! $viewquestion->answer_b !!}</li>
                        <li>{!! $viewquestion->answer_b !!}</li>
                        <li>{!! $viewquestion->answer_c !!}</li>
                      </ol>
                    </td>
                    <td >{{ $viewquestion->question_weight }} </td>
                  </tr>
                  {{-- @endforeach --}}
            </tbody>

        </table>


        {{-- <div class="row">
            <div class="col-sm-8">
            <label>Question</label>
            @foreach ($viewquestion as $key=> $col)
             <p>{{ $examshow->answer_key }}</p>
             @endforeach
            <label>Answer</label>

            <div class="row">

                <dl>
                <ol type="A" >
                    <li>Answer 1</li>
                    <li>Answer 2</li>
                    <li>Answer 3</li>
                    <li>Answer 4</li>
                  </ol>
                  <dt>Correct Answers</dt>
                  <dd>A</dd>
                  <dt>Weightage</dt>
                  <dd>5</dd>
                </dl>
            </div>

            </div>
        </div> --}}
    </div>
</div>
</form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>

        questionsTable = $('#questionsTable').dataTable({

          "dom" : 'lfrtip'
        });

      </script>
@stop
