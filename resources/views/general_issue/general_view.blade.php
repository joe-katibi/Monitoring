@extends('adminlte::page')

@section('title', 'Create-General-Issue')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value=" Create General Issue">
    </div>
        <div class="card-body">
          <div class="row">
            <div class="container">
              <form action="{{route('general.store')}}" method="POST">
                {{csrf_field()}}
                <label>General Name</label>
                <div>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="card-body">
                    @can('view-general-submit-button')
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
                                <th style="width: 10%">AddSubCategory</th>
                                <th style="width: 10%">Action</th>
                              </tr>
                      </thead>
                  <tbody>
               @foreach($crm as $row)
                <tr>
                 <td>{{$row['id']}}</td>
                 <td>{{$row['name']}}</td>
                 <td>
                    @if ($row['service_id']  == '1')
                    <a disable class="badge badge-success" >Cable</a>
                    @elseif($row['service_id']  == '2')
                    <a disable class="badge badge-primary" >DTH</a>
                    @else
                    <a disable class="badge badge-warning" >Global</a>
                    @endif
                </td>
                <td>
                    @can('view-general-add-category-button')
                    <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" href="{{route('general.storeGen',$row['id'])}}">Add</a>
                    @endcan
                </td>
                <td>
                    @can('view-general-action-button')
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('general.edit',$row['id']) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                        <a href="{{ route('general.show',$row['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                         <a href="{{ route('general.destroy',$row['id']) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </div>
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
                <form action="{{route('general.storeGen',$row['id'])}}" method="POST">
                  {{csrf_field()}}
                  <label>SubCategory</label>
                  <input type="text" name="sub_name" class="form-control">
                  <input type="text" name="issue_general_id" value="{{$row['id']}}" hidden>
                  <div class="col-ms-3">
                    <div class="card-body">
                         @can('view-general-save-category-button')
                        <div class="row">
                            <div class="col">
                  <button type="submit" class="btn btn-success float-right">Save</button>
                      </div>
                      </div>
                      @endcan
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
