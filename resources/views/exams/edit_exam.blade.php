@extends('adminlte::page')

@section('title', 'Exam edit')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('exambank.update', $questions[0]->id) }}" method="POST">
  @csrf
    <div class="card card-success " >
        <div class="card-header"> <input readonly class="form-control" style="color: green" value="Edit Question and its choices">
        </div>

        <div class="card-body">
            <div class="container">
                @foreach ($questions as $key => $question)
                <div id="question-{{ $key }}" class="question-card card card-warning {{ $key === 0 ? '' : 'd-none' }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label>Question</label>
                                <input type="text" name="questions[{{ $key }}][question]" class="form-control custom-textarea" rows="3" value="{!! strip_tags($question->question) !!}">
                                <input  type="hidden" name="questions[{{ $key }}][id]" value="{{ $question->id }}">

                                <span style="color:red">@error('questions.'.$key.'.question'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ol type="A">
                            @foreach ($question->choices as $k => $choice)
                            <li>
                                <div class="row">
                                    <div class="col">
                                        <label for="question_weight_a">Answer</label>
                                        <input required type="text" id="choice-{{ $choice->id }}" name="questions[{{ $key }}][choices][{{ $choice->id }}][{{ $k }}][choice]" class="form-control custom-textarea" rows="3" value="{!! strip_tags($choice->choices) !!}">
                                        @error('questions.'.$key.'.choices.'.$k.'.choice')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="question_weight_a">Answer Weight</label>
                                        <input required type="number" id="question_weight-{{ $choice->id }}" name="questions[{{ $key }}][choices][{{ $choice->id }}][{{ $k }}][question_weight]" class="form-control" value="{!! $choice->question_weight !!}">
                                        @error('questions.'.$key.'.choices.'.$k.'.question_weight')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Move the submit button inside the form element -->
        <div class="card-footer">
            <div class="col">
                @can('view-edit-question-button')
                <div class="col-md-12">
                <button type="submit" class="btn btn-success float-right">Edit Question</button>
                </div>
                @endcan
            </div>
        </div>

    </div>
</form> <!-- Close the form element here -->

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
/* Custom styles for increased input height */
.custom-textarea {
    height: 100px; /* Adjust the height as per your requirement */
    resize: vertical; /* Allow vertical resizing of the textarea */
}
</style>
@stop
