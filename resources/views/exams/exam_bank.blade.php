@extends('adminlte::page')

@section('title', 'conduct bank')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')

<form action="#" method="POST" name="listForm">
      @csrf
      <div class="card card-success">
          <div class="card-header">
              <input readonly class="form-control" style="color: green" name="category" value="Exam Bank">
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col">
                    <a href="{{ route('exambank.store') }}" type="button" class="btn btn-success float-right" > Create Questions</a>
                  </div>
                </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="questionsTable">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Question</th>
                        <th>Answer key</th>
                        <th>Weightage</th>
                        <th>Course</th>
                        <th>Service</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                          @foreach ($examquestion as $key=>$row)
                           <tr>
                                 <td>{{$row['id']}}</td>
                                 <td>{!! $row['question']!!}</td>
                                 <td>{{$row['answer_name']}}</td>
                                 <td>{{$row['question_weight']}}</td>
                                 <td>{{$row['course_name']}}</td>
                                 <td>{{$row['service_name']}}</td>
                                 <td>{{$row['created_at']}}</td>
                                 <td>
                                     <div class="btn-group btn-group-sm">
                                         <a href="{{ route('exambank.edit',$row['id']) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                         <a href="{{ route('exambank.show',$row['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                         @method('DELETE')
                                          <a href="{{ route('exambank.destroy',$row['id']) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
