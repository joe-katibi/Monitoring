@extends('adminlte::page')

@section('title', 'Questions')

@section('content_header')
    <h1>Questions</h1>
@stop

@section('content')
  @include('sweetalert::alert')

<form action="#" method="POST" name="listForm">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="{{ $questions[0]['course_name'] }}">
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="questionsTable">
              <thead>
                  <tr>
                      <th>Question</th>
                      <th>Created Date</th>
                      <th style="width: 10%">Action</th>
                  </tr>
              </thead>
                  <tbody>
                        @foreach ($questions as $key=>$row)
                         <tr>
                               <td>{!! $row['question']!!}</td>
                               <td>{{$row['created_at']}}</td>
                               <td>
                                  @can('view-edit-view-delete-button-question')
                                   <div class="btn-group btn-group-sm">
                                       <a href="{{ route('exambank.edit',$row['id']) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                       <a href="{{ route('exambank.show',$row['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                       @method('DELETE')
                                        <a href="{{ route('exambank.destroy',$row['id']) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });

  </script>
@stop
