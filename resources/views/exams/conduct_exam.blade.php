@extends('adminlte::page')

@section('title', 'conduct Exam')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form action="#" method="POST" name="listForm">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Conduct Exam">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                  <a href="/exams/schedule_exam" type="button" class="btn btn-success float-right" > Conduct New Exams</a>
                </div>
              </div>
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
                      <th style="width: 10%">Action</th>
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
                               <td>Active</td>
                               <td>{{ $row->created_at}}</td>
                               <td>
                                   <div class="btn-group btn-group-sm">
                                       <a href="{{ route('conductexam.edit',$row->id) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                       <a href="{{ route('conductexam.show',$row->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('conductexam.destroy',$row->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                   </div>
                          </td>
                      </tr>
                  @endforeach


                  </tbody>
              </table>
          </div>
    </div>

</form>

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
