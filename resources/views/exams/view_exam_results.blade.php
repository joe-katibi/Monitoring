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

            @if ($i = 1)
            <?php $num =1;?>
               @foreach ($exam_results as $key => $questions)
                   <div class="card card-warning ">
                       <div class="card-header">
                        {!!  "Question ".  $num++ . ". ".  strip_tags( $questions->questionDone, '<p>')!!}
                       </div>
                       <div class="card-body">

                       <p>{!! $questions->choices !!}</p>
                           {{-- <div class="form-check">
                               <ol type="A">




                                   @foreach ($questions->answerDone as $k => $choice )
                                   <li>
                                       <input type="radio" id="question-{{ $choice->id }}"
                                           name="question-answer-[{{ $question->id }}]"
                                           value="{{ $choice->id }}">
                                       <label for="examination">{!! $choice->choices !!}</label>
                                       <input  type="hidden" name="questions-choice-[{{ $choice->id }}]"
                                       value="{{ $choice->question_weight }}">

                                   </li>
                                   @endforeach
                               </ol>

                           </div> --}}

                       </div>
                   </div>
               @endforeach
           @endif



        </div>

    </div>
</form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
