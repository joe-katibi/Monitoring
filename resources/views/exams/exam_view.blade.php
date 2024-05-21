@extends('adminlte::page')

@section('title', 'Exam View | Zuku Monitoring')

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

                @foreach ($questions as $key => $question)
                <div id="question-{{ $key }}" class="question-card card card-warning {{ $key === 0 ? '' : 'd-none' }}">
                    <div class="card-header">
                        {!! strip_tags($question->question, '<p>') !!}
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <ol type="A">
                                @foreach ($question->choices as $k => $choice)
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
</form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
