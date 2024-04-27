@extends('adminlte::page')

@section('title', 'View Scheduled Exam')

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
             <div class="col-md-3">
                 <label>Exam Name</label>
                 <input readonly type="text" name="exam_name" class="form-control" placeholder="exam_name" value="{{ $viewquestion[0]['exam_name']}}">
                 </div>
            <div class="col-md-3">
                <label>Exam Code</label>
              <input readonly type="text" name="exam_code" class="form-control" placeholder="exam_code" value="{{ $viewquestion[0]['schedule_id'] }}">
            </div>
            <div class="col-md-3">
                <label>Course</label>
                <input readonly type="text" name="course" class="form-control" placeholder="course" value="{{ $viewquestion[0]['course_name']}}">
            </div>
            <div class="col-md-3">
                <label>Trainer/QA</label>
                <input readonly type="text" name="trainer_qa" class="form-control" placeholder="trainer_qa" value="{{$viewquestion[0]['name'] }}">
            </div>

           <div class="col-md-3">
               <label>Duration (minutes)</label>
               <input readonly type="text" name="course" class="form-control" placeholder="course" value="{{ $viewquestion[0]['time']}}">
           </div>

           <div class="col-md-3">
               <label>Department</label>
               <input readonly type="text" name="department" class="form-control" placeholder="department" value="{{ $viewquestion[0]['category_name'] }}">
           </div>
           <div class="col-md-3">
               <label>Status</label>
               <input readonly type="text" name="status" class="form-control" placeholder="status" value="{{ $viewquestion[0]['status_name'] }}">
           </div>
        </div>
    </div>

    <div class="container">
        <div class="card body">
        <div class="row">
            <div class="col-6">
                <label>Date Started</label>
                <input readonly type="text" name="date_start" class="form-control" placeholder="date_start" value="{{ $viewquestion[0]['start_date']}}">
                </div>
           <div class="col-6">
               <label>Date Completion</label>
             <input readonly type="text" name="date_completion" class="form-control" placeholder="date_completion" value="{{  $viewquestion[0]['completion_date'] }}">
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

        <div class="container">
            <div class="card-body float-center ">

                @foreach ($viewquestion as $key => $questions)
                <div class="question-card card card-warning">
                    <div class="card-header">
                        {!! strip_tags($questions->question[0]['question'], '<p>') !!}
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <ol type="A">
                                @foreach ($questions->question[0]['choices'] as $k => $choice)
                                <li>
                                    <div class="row">
                                        <div class="col">
                                            <label for="question_weight_a">Answer</label>
                                    <input readonly name="correct_answer" class="form-control float-center"  value="{!! strip_tags($choice->choices) !!}">
                                </div>
                                <div class="col-md-3">
                                    <label for="question_weight_a">Answer Weight</label>
                  <input readonly type="number" id="question_weight_a" name="question_weight_[{{ old('answer_a')}}]" class="form-control" placeholder="Weightage" value="{!! $choice->question_weight !!}">

                            </div>
                        </div>
                                </li>
                            @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                @endforeach

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

    <script>

        questionsTable = $('#questionsTable').dataTable({

          "dom" : 'lfrtip'
        });

      </script>
@stop
