@extends('adminlte::page')

@section('title', 'Exam-Questions')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
 @include('sweetalert::alert')

<form action="#" method="POST" name="listForm">
      @csrf
      <div class="card card-success">
          <div class="card-header">
              <input readonly class="form-control" style="color: green" name="category" value="Exam Bank">
          </div>
          <div class="card-body">
            @can('view-create-question-page',)
              <div class="row">
                  <div class="col">
                    <a href="{{ route('exambank.create') }}" type="button" class="btn btn-success float-right" > Create Questions</a>
                  </div>
                </div>
                @endcan
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="questionsTable">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Service</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                          @foreach ($examquestion as $key=>$row)
                           <tr>
                                 <td>{{$row['course_name']}}</td>
                                 <td>
                                    @if ($row['service_name'] == 'Cable')
                                    <a disable class="badge badge-success" >Cable</a>
                                    @else
                                    <a disable class="badge badge-primary">DTH</a>
                                    @endif
                                </td>
                                 <td>{{$row['created_at']}}</td>
                                 <td>
                                    @can('view-edit-view-delete-button-question')
                                     <div class="btn-group btn-group-sm">
                                         <a href="{{ route('view_questions.questionShow',$row['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i>View Questions</a>
                                     </div>
                                     @endcan
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script>

@stop
