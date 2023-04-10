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

                                @if ($row->status == 'active')
                                <a disable class="badge badge-success" >active</a>
                                @else
                                <a disable class="badge badge-danger" >inactive</a>
                                @endif


                               </td>
                               <td>{{ $row->created_at}}</td>
                               <td>
                                @can('view-start-results-exam-buttons')

                                  @if($row->status == 'inactive')
                                  <a style="display:none;" href="{{ route('examination.index',$row->id) }}" class="btn btn-success"><i class="fas fa-play" ></i>Start</a>
                                  @else
                                  <a href="{{ route('examination.index',$row->id) }}" class="btn btn-success"><i class="fas fa-play" ></i>Start</a>
                                  @endif

                                  @if($row->status == 'active')

                                  <a style="display:none;" href="{{ route('examresult.create',$row->id) }}" class="btn btn-info"><i class="fas fa-eye"></i>Results</a>

                                  @else

                                  <a href="{{ route('examresult.create',$row->id) }}" class="btn btn-info"><i class="fas fa-eye"></i>Results</a>

                                  @endif

                                  @endcan
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

      "dom" : 'lfrtip'
    });

  </script>
@stop
