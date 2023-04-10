@extends('adminlte::page')

@section('title', 'view course')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="#" method="POST" name="listForm">
      @csrf
      <div class="card card-success">
          <div class="card-header">
              <input readonly class="form-control" style="color: green" name="category" value="Course">
          </div>
          <div class="card-body">
            @can('view-create-course-button')
            <div class="row">
                <div class="col">
                  <a href="{{ route('create_course.create') }}" type="button" class="btn btn-success float-right" > Create Course</a>
                </div>
              </div>
            @endcan
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="questionsTable">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Course</th>
                        <th>Services</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                          @foreach ($Course as $row)
                           <tr>
                            <td>{{$row['id']}}</td>
                            <td>{{$row['course_name']}}</td>
                            <td>

                                @if ($row->service_name  == 'Cable')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif

                            </td>
                            <td>{{$row['created_at']}}</td>
                                 <td>
                                    @can('view-edit-delete-course-button')
                                     <div class="btn-group btn-group-sm">
                                         <a href="{{ route('create_course.edit',$row['id']) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                         @method('DELETE')
                                         <a href="{{ route('create_course.destroy',$row['id']) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
