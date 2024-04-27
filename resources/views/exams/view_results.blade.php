@extends('adminlte::page')

@section('title', 'Exam Results')

@section('content_header')
<style>
    .container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f0f0f0;
    }
    #makepdf {
        box-sizing: border-box;
        width: 100%;
        max-width: 1200px; /* Set a max-width for the card */
        padding: 30px;
        border: 1px solid black;
        font-style: sans-serif;
        background-color: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: auto; /* Add scrollbars if content overflows */
    }
    h3 {
        text-align: center;
        color: #24650b;
    }

    /* Add new styles for images */
    .images-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 20px;
    }

    .image {
        width: 20%;
    }
</style>
@stop

@section('content')
<body>
    <div class="container">
        <div  class="body" id="makepdf">
          <div class="images-container">
            <img class="image" src="{{ asset('assets/img/wananchi_logo.png') }}" >
            <img class="image" src="{{ asset('assets/img/zuku-logo.png') }}" >
        </div>
        <h3>WANANCHI PRODUCT KNOWLEDGE TEST RESULTS</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Agent Name:</label>
                    <input readonly value="{{ $exam_results['name'] }}" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date:</label>
                    <input readonly value="{{ $exam_results['created_at'] }}"  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Exam Name:</label>
                    <input readonly value="{{ $exam_results['exam_name'] }}" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Grade:</label>
                    <input readonly value="{{ $grade }}" type="text" class="form-control">
                </div>
            </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Total Questions</h6>
                    <p>{{ $totalQuestions }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Correct Answers</h6>
                    <p>{{ $correctAnswers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h6>Wrong Answers</h6>
                    <p>{{ $wrongAnswers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6>Marks Achieved</h6>
                    <p>{{ $percentage }} %</p>
                </div>
            </div>
        </div>
    </div>

    {{-- <table class="table">
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
                <td>{!! $exam_result->question !!} </td>
                <td>{!! $exam_result->choices !!}</td>
                <td>{{ $exam_result->question_weight}} %</td>
                <td>{{ $exam_result->where('question_weight',">", 0)->first()->choices }}</td>
                <td>{{ $exam_result->marks_achieved }}%</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total Marks Achieved:</th>
                <td>{{ $totalMarks }}%</td>
            </tr>
        </tfoot>
    </table> --}}
</div>
</div>
</body>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@stop
