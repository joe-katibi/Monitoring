@extends('adminlte::page')

@section('title', 'Tracker')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Call tracker">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                  <a href="{{ route('call_tracker.create') }}" type="button" class="btn btn-success float-right" > Create Tracker</a>
                </div>
              </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="questionsTable">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Call tracker</th>
                        <th>Call Nature</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        {{-- @if($call_tracker->sub_call_tracker) --}}
                          @foreach ($list as $key=>$item)
                           <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->call_tracker}}</td>
                            <td>{{$item->sub_call_tracker}}</td>
                            <td>date</td>
                            {{-- <td>{{$row['created_at']}}</td> --}}
                                 <td>
                                     <div class="btn-group btn-group-sm">
                                         <a href="#" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                          <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                     </div>
                            </td>
                        </tr>
                    @endforeach
                    {{-- @endif --}}

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
