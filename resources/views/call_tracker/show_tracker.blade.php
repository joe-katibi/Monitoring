@extends('adminlte::page')

@section('title', 'Tracker | Zuku Monitoring')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="{{ $list[0]->call_tracker }}">
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="questionsTable">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Sub Call tracker</th>
                        <th>Service</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->sub_call_tracker}}</td>
                        <td>
                            @if ($item->service_id == '1')
                            <a class="badge badge-success">Cable</a>
                            @else
                            <a class="badge badge-primary">DTH</a>
                            @endif
                        </td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            @can('view-button-edit-delete-view-tracker')
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('call_tracker.update', $item->id) }}" data-toggle="modal" data-target="#exampleModal{{$item->id}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                @method('DELETE')
                                <a href="{{ route('call_tracker.destroy', $item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                            @endcan
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('call_tracker.update', $item->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <label for="name">Edit SubCategory</label>
                                        <input type="text" name="edit_sub_call_tracker" class="form-control" value="{{$item->sub_call_tracker}}">
                                        <input type="hidden" name="edit_call_tracker_id" value="{{$item->id}}">
                                        <div class="col-ms-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    @can('view-save-category-button')
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-success float-right">Save changes</button>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
    $('#questionsTable').dataTable({
      "dom": 'lfrtip'
    });
</script>
@stop
