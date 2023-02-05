@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value=" Create Category">
    </div>
        <div class="card-body">
          <div class="row">
            <div class="container">
              <form action="{{route('call_tracker.store')}}" method="POST">
                {{csrf_field()}}
                <label for="call_tracker">Category Name</label>
                <input type="text" name="call_tracker" class="form-control">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                      </div>
                </div>

              </form>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="questionsTable">
                       <thead>
                              <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>AddSubCategory</th>
                              </tr>
                      </thead>
                  <tbody>
               @foreach($crm as $row)
                <tr>
                 <td>{{$row->id}}</td>
                 <td>{{$row->call_tracker}}</td>
                 <td><a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" href="{{route('call_tracker.storeSub',$row->id)}}">Add</a></td>
                </tr>

                <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add SubCategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('call_tracker.storeSub',$row->id)}}" method="POST">
                  {{csrf_field()}}
                  <label for="name">SubCategory</label>
                  <input type="text" name="sub_call_tracker" class="form-control">
                  {{-- <label for="image">Image</label> --}}
                  <input type="text" name="call_tracker_id" value="{{$row->id}}" hidden>
                  <div class="col-ms-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                  <button type="submit" class="btn btn-success float-right">Save changes</button>
                      </div>
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
                @endforeach
              </tbody>
            </table>

           </div>
        </div>
      </div>
    </div>

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
