@extends('adminlte::page')

@section('title', 'Tracker')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Call tracker">
        </div>
        <div class="card-body">
            @can('view-button-create-tracker')
            <div class="row">
                <div class="col">
                  <a href="{{ route('call_tracker.create') }}" type="button" class="btn btn-success float-right" > Create Tracker</a>
                </div>
              </div>
              @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="questionsTable">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Call tracker</th>
                        <th>Call Nature</th>
                        <th>Service</th>
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
                            <td>
                                @if ($item->service_name  == 'Cable')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            {{-- <td>{{$row['created_at']}}</td> --}}
                                 <td>
                                    @can('view-button-edit-delete-view-tracker')

                                     <div class="btn-group btn-group-sm">
                                         <a href="{{ route('call_tracker.edit',$item->id) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                         <a href="{{ route('call_tracker.show',$item->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                          <a href="{{ route('call_tracker.destroy',$item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                     </div>

                                    @endcan
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
