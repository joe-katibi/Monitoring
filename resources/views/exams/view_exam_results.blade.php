@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden>View exams Results</h1>
@stop

@section('content')
<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="View exams Results">
        </div>
        <div class="card-body">

            <?php $num = 1; ?>
            @foreach ($exam_results as $result)
                <div class="card card-warning">
                    <div class="card-header">
                        {!! "Question " . $num++ . ". " . strip_tags($result['questionDone'], '<p>') !!}
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <ol type="A">
                                @foreach ($result['answerDone'] as $index => $answer)
                                    <li>
                                        <div class="row">
                                            <div class="col">
                                                <label for="question_weight_a">Answer</label>
                                                <input readonly name="correct_answer" class="form-control float-center {{ $index == $result['question_weight'] ? 'bg-green' : 'bg-red' }}" value="{!! strip_tags($answer) !!}">
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
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .bg-green {
            background-color: #a3e8a0;
        }

        .bg-red {
            background-color: #ff9f9f;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
