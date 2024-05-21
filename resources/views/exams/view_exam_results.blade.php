@extends('adminlte::page')

@section('title', 'View exams Results | Zuku Monitoring')

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
                                        <?php
                                            $answerClass = '';

                                            // Highlight the correct answer
                                            if ($result['is_correct'][$index] == 1) {
                                                $answerClass = 'bg-green';
                                            }

                                            // Highlight the user's selected answer
                                            if ($index === $result['answers_selected']) {
                                                if ($result['is_correct'][$index] == 1) {
                                                    $answerClass = 'bg-green'; // Correct answer selected by user
                                                } else {
                                                    $answerClass = 'bg-red'; // Incorrect answer selected by user
                                                }
                                            }
                                        ?>
                                        <input readonly name="correct_answer" class="form-control float-center {{ $answerClass }}" value="{!! strip_tags($answer) !!}">
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
