@extends('adminlte::page')

@section('title', 'Exam-Results')

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
            @can('view-results-exam-button-menu')
            <div class="row">
                <div class="col">
                  <a href="#" type="button" class="btn btn-success float-right" > Conduct New Exams</a>
                </div>
              </div>
              @endcan
        </div> --}}
        <div class="card-body">
          <table class="table table-bordered" id="questionsTable">
              <thead>
                  <tr>
                      {{-- <th style="width: 10px">No</th> --}}
                      <th>Exam Name</th>
                      <th>Course</th>
                      <th>Service</th>
                      <th>Trainier/QA</th>
                      <th>Department</th>
                      <th>Total Results</th>
                      <th> Date</th>
                      <th style="width: 10%">Action</th>
                  </tr>
              </thead>
                  <tbody>
                        @foreach ($examresults as $key=>$row)
                         <tr>
                               <td>{{ $row['exam_name'] }}</td>
                               <td>{{ $row['course_name'] }}</td>
                               <td>

                                {{-- {{ $row['service_name'] }} --}}

                                @if ($row->s_id == '1')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif



                            </td>
                               <td>{{ $row['name'] }}</td>
                               <td>{{ $row ['category_name']}}</td>
                               <td>{{ $row ['marks_achieved']}}%</td>
                               <td>{{ $row['completion_date'] }}</td>
                               {{-- <td>{{ $row }}</td> --}}
                               <td>
                                   <div class="btn-group btn-group-sm">
                                       <a href="{{ route('examresult.show',$row['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
