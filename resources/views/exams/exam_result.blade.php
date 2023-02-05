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
            <input readonly class="form-control" style="color: green" name="category" value="Exam Results">
        </div>
        {{-- <div class="card-body">
            <div class="row">
                <div class="col">
                  <a href="#" type="button" class="btn btn-success float-right" > Conduct New Exams</a>
                </div>
              </div>
        </div> --}}
        <div class="card-body">
          <table class="table table-bordered" id="questionsTable">
              <thead>
                  <tr>
                      <th style="width: 10px">No</th>
                      <th>Exam Name</th>
                      <th>Course</th>
                      <th>Total Questions</th>
                      <th>Trainier/QA</th>
                      <th>Department</th>
                      <th>Time</th>
                      <th> Date</th>
                      <th style="width: 10%">Action</th>
                  </tr>
              </thead>
                  <tbody>
                        {{-- @foreach ($examquestion as $key=>$row) --}}
                         <tr>
                               <td>1</td>
                               <td>Gpon Exam</td>
                               <td>GPON TV and GPON internet</td>
                               <td>20</td>
                               <td>26/12/2022 2:00:00 pm</td>
                               <td>Jone Don</td>
                               <td>cable inbound, Digital, Cable outbound</td>
                               <td>25/12/2022</td>
                               <td>
                                   <div class="btn-group btn-group-sm">
                                       <a href="/exams/view_exam_results" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                   </div>
                          </td>
                      </tr>
                  {{-- @endforeach --}}

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
