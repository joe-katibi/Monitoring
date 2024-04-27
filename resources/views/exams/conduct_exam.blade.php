@extends('adminlte::page')

@section('title', 'conduct Exam')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="#"  name="listForm">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Conduct Exam">
        </div>
        <div class="card-body">
            @can('view-new-conduct-page-button')
            <div class="row">
                <div class="col">
                  <a href="{{ route('conductexam.create') }}" type="button" class="btn btn-success float-right" > Conduct New Exams</a>
                </div>
              </div>
            @endcan
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
                      <th>Durations(minutes)</th>
                      <th>Trainier/QA</th>
                      <th>Department</th>
                      <th>Status</th>
                      <th>Re-activate</th>
                      <th>Created Date</th>
                      <th style="width: 10px">Action</th>
                  </tr>
              </thead>
                  <tbody>

                        @foreach ($conduct as $key=> $row)

                        {{-- @dd($row); --}}
                         <tr>
                               <td>{{ $row->id}}</td>
                               <td>{{ $row->exam_name}}</td>
                               <td>{{ $row->schedule_id }}</td>
                               <td>{{ $row->course_name }}</td>
                               <td>{{ $row->total_questions }}</td>
                               <td>{{ $row->time }}</td>
                               <td>{{ $row->name }}</td>
                               <td>{{ $row->category_name }}</td>
                               <td>
                                @if ($row->status  == '1')
                                <a disable class="badge badge-success" >Active</a>
                                @else
                                <a disable class="badge badge-warning" >Inactive</a>
                                @endif
                               </td>
                               <td>
                                @if ($row->status == '0')
                                <form action="{{ url('exams/conduct_exams/'. $row->id .'/reactivate') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success activate-button">
                                        <i class="fas fa-recycle"></i> Reactivate
                                    </button>
                                </form>

                                @else
                                <form action="{{ route('exams.conduct_exams.deactivate', $row->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-warning activate-button">
                                        <i class="fas fa-recycle"></i> Deactivate
                                    </button>
                                </form>
                                @endif
                               </td>
                               <td>{{ $row->created_at}}</td>
                               <td>
                                @can('view-edit-view-delete-conduct--button')
                                   <div class="btn-group btn-group-sm">
                                       <a href="{{ route('conductexam.edit',$row->id) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                       <a href="{{ route('conductexam.show',$row->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('conductexam.destroy',$row->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
       ordering:false,
      "dom" : 'lfrtip'
    });

  </script>

<script>
    // Wait for the DOM to finish loading
    window.addEventListener('DOMContentLoaded', function() {
        // Add an event listener to the button
        document.querySelector('.activate-button').addEventListener('click', function(event) {
            // Get the URL from the button's data attribute
            var url = event.target.getAttribute('data-url');

            // Send a GET request to the server to reactivate the row
            fetch(url).then(function(response) {
                // Handle the response from the server
                if (response.ok) {
                    // The row was successfully reactivated
                    console.log('Row reactivated!');
                } else {
                    // There was an error reactivating the row
                    console.error('Error reactivating row:', response.statusText);
                }
            });
        });
    });
</script>

@stop
