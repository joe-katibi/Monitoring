@extends('adminlte::page')

@section('title', 'Examination')

@section('content_header')
    <h1 hidden>Eximantion</h1>
@stop

@section('content')
@include('sweetalert::alert')
{{-- action="{{ route('examination.store') }}" --}}
    <form  method="POST" action="{{ route('examination.store',$conduct[0]->id) }}" name="listForm">
        <input  type="hidden" name="conduct_id" value="{{ $conduct[0]->id}}">
        <input  type="hidden" name="created_by" value="{{ Auth::user()->id }}">
        <input type="hidden" name="reporttype" value="{{ $reporttype['type_id']}}">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @csrf
        <div class="card card-success">
            <div class="card-header">
                <input readonly class="form-control" style="color: green" value="Examination">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label>Name</label>
                        <input readonly type="text" class="form-control" placeholder="Agent" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-2">
                        <label>Trainer/QA</label>
                        <input readonly type="text" class="form-control" placeholder="Trainer"
                            value="{{ $conduct[0]->name }}">
                    </div>
                    <div class="col-2">
                        <label>Department</label>
                        <input readonly type="text" class="form-control" placeholder="Department"
                            value="{{ $conduct[0]->category_name }}">
                    </div>
                    <div class="col-2">
                        <label>Exam Name</label>
                        <input readonly type="text" class="form-control" placeholder="Exam Name"
                            value="{{ $conduct[0]->exam_name }}">
                    </div>
                    <div class="col-2">
                        <label>No of Questions</label>
                        <input readonly type="text" class="form-control" placeholder="number of Questions"
                            value="">
                    </div>
                    <div class="col-2">
                        <label>Duration (minutes) </label>
                        <input readonly id="timer" type="text" class="form-control" placeholder="Durations"
                            value="{{  $timeRemaining }}">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <div class="col-right">
                            <label>Exams Starts at: </label>
                            <a class="badge badge-success">{{ $start_time}}</a>

                            <label id="examEnd">Exams Ends at:</label>
                            <a class="badge badge-danger">{{ $end_time}}</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="container">
                    @if ($i = 1)
                     <?php $num =1;?>
                        @foreach ($questions as $key => $question)
                            <div class="card card-warning ">
                                <div class="card-header">
                                 {!!  "Question ".  $num++ . ". ".  strip_tags( $question->question, '<p>')!!}
                                </div>
                                <div class="card-body">
                                    {{-- <input  type="hidden" name="questions[{{ $question->course }}]"
                                        value="{{ $question->course }}"> --}}
                                        <input  type="hidden" name="schedule[{{ $question->id }}]"
                                        value="{{ $question->id  }}">
                                    <div class="form-check">
                                        <ol type="A">
                                            @foreach ($question->choices as $k => $choice)
                                            <li>
                                                <input type="radio" id="question-{{ $choice->id }}"
                                                    name="question-answer-[{{ $question->id }}]"
                                                    value="{{ $choice->id }}">
                                                <label for="examination">{!! $choice->choices !!}</label>
                                                {{-- <input  type="hidden" name="questions-choice-[{{ $choice->id }}]"
                                                value="{{ $choice->question_weight }}"> --}}

                                            </li>
                                            @endforeach
                                        </ol>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                    @can('view-saving-done-exam-button')
                    <div class="card-footer">

                        <button  type="submit" class="btn btn-success float-right">Submit</button>

                    </div>

                    @endcan


                </div>
            </div>

        </div>

    </form>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js"></script>

    <script>
        questionsTable = $('#tableList').dataTable({

            "dom": 'lfrtip'
        });
    </script>

    {{-- <script>
        function deactivateExam() {
            axios.post('{{ route('examination.show') }}')
                .then(response => {
                    window.location.reload();
                });
        }

        let timeLeft = {{ $examEnd->diffInSeconds(Carbon::now()) }};
        let timer = setInterval(() => {
            if (timeLeft === 0) {
                clearInterval(timer);
                deactivateExam();
            }
            timeLeft--;
        }, 1000);
    </script> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js"></script>



@stop
