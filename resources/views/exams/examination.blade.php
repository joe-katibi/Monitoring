@extends('adminlte::page')

@section('title', 'Examination | Zuku Monitoring')

@section('content_header')
    <h1 hidden>Eximantion</h1>
@stop

@section('content')
@include('sweetalert::alert')
{{-- action="{{ route('examination.store') }}" --}}
    <form  method="POST" action="{{ route('examination.store',$conduct->id) }}" name="listForm">
        <input  type="hidden" name="conduct_id"  id="conductId" data-conduct-id="{{ $conduct->id}}" value="{{ $conduct->id}}">
        <input  type="hidden" name="created_by" id="createdBy" data-created-by="{{ Auth::user()->id  }}" value="{{ Auth::user()->id }}">
        <input type="hidden" name="reporttype" value="{{ $reporttype['type_id']}}">
        <input type="hidden" name="examId" id="scheduleId" value="{{ $examID['schedule_id']}}">
        <input type="hidden" name="timeRemaining" id="timeRemaining" value="{{$timeRemaining}}">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @csrf
        <div class="card card-success">

            <div id="alert-message" style="display: none;">
                <p>Your time has elapsed. Exam submission in progress...</p>
            </div>
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
                            value="{{ $conduct->name }}">
                    </div>
                    <div class="col-2">
                        <label>Department</label>
                        <input readonly type="text" class="form-control" placeholder="Department"
                            value="{{ $conduct->category_name }}">
                    </div>
                    <div class="col-2">
                        <label>Exam Name</label>
                        <input readonly type="text" class="form-control" placeholder="Exam Name"
                            value="{{ $conduct->exam_name }}">
                    </div>
                    <div class="col-2">
                        <label>No of Questions</label>
                        <input readonly type="text" class="form-control" placeholder="number of Questions"
                            value="{{ $total_questions }}">
                    </div>
                    <div class="col-2">
                        <label>Duration (minutes) </label>

                            <input readonly id="timer" type="text" class="form-control" value="{{ $timeRemaining }}">
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
        <div id="questionContainer">
            <!-- First question will be displayed by default -->
            @foreach ($questions as $key => $question)
            <div id="question-{{ $key }}" class="question-card card card-warning {{ $key === 0 ? '' : 'd-none' }}">
                <div class="card-header">
                    {!!  "Question ".  ($key+1) . ". " . strip_tags($question->question, '<p>') !!}
                </div>
                <div class="card-body">
                    <input type="hidden" name="questions[{{ $question->course }}]" value="{{ $question->course }}">
                    <input  type="hidden" name="schedule[{{ $question->id }}]" value="{{ $question->id }}">
                    <div class="form-check">
                        <ol type="A">
                            @foreach ($question->choices as $k => $choice)
                            <li>
                                <input type="radio" id="choice-{{ $choice->id }}" name="question-answer-[{{ $question->id }}]"
                                       value="{{ $choice->id }}" required>
                                <label for="choice-{{ $choice->id }}">{!! $choice->choices !!}</label>
                                <input  type="hidden" name="questions-choice-[{{ $choice->id }}]"
                                    value="{{ $choice->question_weight }}">
                            </li>
                        @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="navigation-buttons">
            <button type="button" class="btn btn-primary" data-action="prev"  onclick="changeQuestion(-1)">Previous</button>
            <button type="button" class="btn btn-primary" data-action="next" onclick="changeQuestion(1)">Next</button>
            @can('view-saving-done-exam-button')
            <button type="submit" class="btn btn-success d-none" id="submitBtn">Submit</button>
            @endcan
        </div>
    </div>
</div>

        </div>

    </form>


@stop

@section('css')
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
   let currentQuestion = 0;
   const totalQuestions = {{ count($questions) }};

    function showQuestion(questionNumber) {
        document.getElementById('question-' + currentQuestion).classList.add('d-none');
        document.getElementById('question-' + questionNumber).classList.remove('d-none');
        currentQuestion = questionNumber;
        updateNavigationButtons();
    }

    function updateNavigationButtons() {
    const prevBtn = document.querySelector('.navigation-buttons button[data-action="prev"]');
    // Changed the selector for the next button
    const nextBtn = document.querySelector('.navigation-buttons button[data-action="next"]');
    const submitBtn = document.getElementById('submitBtn');

    prevBtn.disabled = currentQuestion === 0;
    nextBtn.classList.toggle('d-none', currentQuestion === totalQuestions - 1);
    submitBtn.classList.toggle('d-none', currentQuestion !== totalQuestions - 1);
    }

    function changeQuestion(direction) {
        const nextQuestion = currentQuestion + direction;
        if (nextQuestion >= 0 && nextQuestion < totalQuestions) {
            showQuestion(nextQuestion);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize with the first question displayed
        showQuestion(currentQuestion);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var endTime = localStorage.getItem('examEnd'); // Get the end time from local storage

        // Check if the end time is stored in local storage and is valid
        if (endTime && !isNaN(endTime) && parseInt(endTime) > Date.now()) {
            endTime = parseInt(endTime); // Parse the stored end time as an integer
        } else {

            // Set a new end time (e.g., 30 minutes from now)
            // endTime = Date.now() + (30 * 60 * 1000); // 30 minutes in milliseconds $timeRemaining
            endTime = Date.now() + (parseInt({{ $conduct->duration }}) * 60 * 1000); // 30 minutes in milliseconds
            localStorage.setItem('examEnd', endTime); // Store the end time in local storage
        }

        // Update the countdown every second
        var countdownInterval = setInterval(function() {
            var now = Date.now(); // Get the current time in milliseconds
            var distance = endTime - now; // Calculate the remaining time in milliseconds

            // Check if the countdown has reached zero or less
            if (distance <= 0) {
                clearInterval(countdownInterval); // Stop the countdown
                document.getElementById('timer').value = 'Time is up!'; // Display a message when the time is up

                // Clear the stored end time from local storage
                localStorage.removeItem('examEnd');

                // Make an AJAX request to store the selected answers
                saveAnswersAndRedirect();
            } else {
                // Calculate the minutes and seconds
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the countdown in the input element with the ID 'timer'
                document.getElementById('timer').value = minutes + ' minutes, ' + seconds + ' seconds';
            }
        }, 1000); // Update the countdown every second (1000 milliseconds)

        function saveAnswersAndRedirect() {
            clearInterval(countdownInterval);



            // Collect data from the form
            const formData = new FormData(document.forms.namedItem("listForm"));
            console.log(formData);

            dd(formData);

            // Perform an AJAX request to save answers
            fetch("{{ route('examination.store', $conduct->id) }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },

            })
            .then((response) => {
                if (response.ok) {
                    // Redirect to the results page after saving answers
                    setTimeout(function () {
                        var conductId = document.getElementById('conductId').value;
                        var createdBy = document.getElementById('createdBy').value;
                        var scheduleId = document.getElementById('scheduleId').value;
                        window.location.href = "/exams/view_results/" + conductId + "/" + createdBy + "/" + scheduleId;
                    }, 2000); // Redirect after 2 seconds
                } else {
                    // Handle the case when saving answers fails
                    document.getElementById('alert-message').textContent = "Error while saving answers.";
                    document.getElementById('alert-message').style.display = 'block';
                }
            })
            .catch((error) => {
                // Handle network errors here
                document.getElementById('alert-message').textContent = "Network error occurred.";
                document.getElementById('alert-message').style.display = 'block';
            });
        }
    });
</script>


@stop
