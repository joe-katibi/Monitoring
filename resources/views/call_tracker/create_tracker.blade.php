@extends('adminlte::page')

@section('title', 'Call tracker category')

@section('content_header')

<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
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
                <div>
                    <input type="text" name="call_tracker" class="form-control" required>
                </div>
                <label>Service</label>
                <div>
                    <select class="custom-select"id="service_id" name="service_id" data-placeholder="service">
                    <option>---Select option----</option>
                    @foreach ($service as $row)
                    <option value="{{$row['id']}}">{{$row['service_name']}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="card-body">
                    @can('view-add-category-tracker')
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                      </div>

                    @endcan
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
                                <th>Service</th>
                                <th>AddSubCategory</th>
                              </tr>
                      </thead>
                  <tbody>
               @foreach($crm as $row)
                <tr>
                 <td>{{$row->id}}</td>
                 <td>{{$row->call_tracker}}</td>
                 <td>
                    @if ($row->service_name  == 'Cable')
                    <a disable class="badge badge-success" >Cable</a>
                    @else
                    <a disable class="badge badge-primary" >DTH</a>
                    @endif
                </td>
                 <td>
                    @can( 'view-add-category-button')
                    <a class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" href="{{route('call_tracker.storeSub',[$row->id, $row->service_id])}}">Add</a>
                    @endcan

                </td>
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
                <form action="{{route('call_tracker.storeSub',[$row->id, $row->service_id])}}" method="POST">
                  {{csrf_field()}}
                  <label for="name">SubCategory</label>
                  <input type="text" name="sub_call_tracker" class="form-control">
                  <input type="hidden" name="call_tracker_id" value="{{$row->id}}" >
                  <input type="hidden" name="service_id" value="{{$row->service_id}}" >
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
