@extends('adminlte::page')

@section('title', 'Exam Results')

@section('content_header')
    <h1 hidden>Dashboard</h1>
@stop

@section('content')

<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" value="Exam Results">
    </div>
</div>
    <div class="card">
        <h1 hidden>Dashboard</h1>

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>Total Questions</h3>
                    <p>{{ $totalQuestions }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>Correct Answers</h3>
                    <p>{{ $correctAnswers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h3>Wrong Answers</h3>
                    <p>{{ $wrongAnswers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h3>Total Marks Achieved</h3>
                    <p>{{ $totalMarks }}</p>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Correct Answer</th>
                <th>Question Marks</th>
                <th>Marks Achieved</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exam_results as $exam_result)
            <tr>
                <td>{!! $exam_result->question !!}</td>
                <td>{!! $exam_result->choices !!}</td>
                <td>{{ $exam_result->question_weight}}</td>
                {{-- <td>{{ $exam_result->where('question_weight',">", 0)->first()->choices }}</td> --}}
                <td>{{ $exam_result->marks_achieved }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Marks Achieved:</th>
                <td>{{ $totalMarks }}</td>
            </tr>
        </tfoot>
    </table>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@stop
