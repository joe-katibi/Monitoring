@extends('adminlte::page')

@section('title', 'Examination-view')

@section('content_header')
    <h1 hidden>Dashboard</h1>
@stop

@section('content')
<form action="#" method="POST" name="listForm">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" value="List Exam">
            <input type="hidden" class="form-control" name="created_by" value="{{ Auth::user()->name }}">
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="questionsTable">
              <thead>
                  <tr>
                      <th style="width: 10px">No</th>
                      <th>Exam Name</th>
                      <th>Exam Code</th>
                      <th>Course</th>
                      <th>Total Questions</th>
                      <th>Time</th>
                      <th>Trainier/QA</th>
                      <th>Department</th>
                      <th>Status</th>
                      <th>Created Date</th>
                      <th >Action</th>
                  </tr>
              </thead>
                  <tbody>

                        @foreach ($conduct as $key=> $row)
                         <tr>
                               <td>{{ $row->id}}</td>
                               <td>{{ $row->exam_name}}</td>
                               <td>{{ $row->schedule_id }}</td>
                               <td>{{ $row->course_name }}</td>
                               <td>20</td>
                               <td>{{ $row->time }}</td>
                               <td>{{ $row->name }}</td>
                               <td>{{ $row->category_name }}</td>
                               <td>
                                @if ($row->status == '1')
                                <a disable class="badge badge-success" >active</a>
                                @else
                                <a disable class="badge badge-danger" >inactive</a>
                                @endif
                               </td>
                               <td>{{ $row->created_at}}</td>
                               <td>

                                @php
                                   $examId = $row->id;
                                   $scheduleId = $row->schedule_id;
                                   $created_by = $userId;
                                   $hasExamAttempt = isset($examAttempts[$examId]) || isset($examAttempts[$scheduleId]);
                                 @endphp
                                @if ($hasExamAttempt)
                                  <!-- The user has already taken the exam, hide the start button and show the results button -->
                                 @can('view-start-results-exam-buttons')
                                <a style="display:none;" href="{{ route('examination.index', $row->id) }}" class="btn btn-success"><i class="fas fa-play"></i>Start</a>
                                <a href="{{ route('examresult.viewResults', ['conductid' => $examId, 'examresult' => $created_by, 'examid' => $scheduleId]) }}" class="btn btn-info"><i class="fas fa-eye"></i>Results</a>
                                 @endcan
                                 @can('view-exam-results-question-with-answers')
                                <a href="{{ route('examresult.show', ['examresult' => $examId, 'schedule_id' => $scheduleId]) }}" class="btn btn-info"><i class="fas fa-eye"></i>Results</a>
                                @endcan
                               @else
                             <!-- The user has not taken the exam, show the start button and hide the results button -->
                             @can('view-start-results-exam-buttons')
                              <a href="{{ route('examination.index', $row->id) }}" class="btn btn-success"><i class="fas fa-play"></i>Start</a>
                            <a style="display:none;" href="{{ route('examresult.show', ['examresult' => $examId, 'schedule_id' => $scheduleId]) }}" class="btn btn-info"><i class="fas fa-eye"></i>Results</a>
                            @endcan
                            @endif

                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
    </div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>

    questionsTable = $('#questionsTable').dataTable({
        ordering:false,
      "dom" : 'lfrtip'
    });

  </script>
@stop
