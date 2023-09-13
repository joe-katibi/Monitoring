@extends('adminlte::page')

@section('title', 'summary')

@section('content_header')
    <h1 hidden>Summary</h1>
@stop

@section('content')
@include('sweetalert::alert')
<div class="row">

    <div class="col-md-4">

<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Strength Summary">
        </div>
        <div class="card-body">
            <div class="row">
                @can('view-strenght-summary-button')
                <div class="col">
                  <a href="{{ route('summaryview') }}"  data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-success float-right" > Create Strength Summary</a>
                </div>

                @endcan
              </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="strengthSummaryTable">
                <thead>
                    <tr>
                        <th>Gap Summary</th>
                        <th>Service</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                          @foreach ($sumry as $row)
                           <tr>
                            <td>{{$row->summary_name}}</td>
                            <td>
                                @if ($row->service_name == 'Cable')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                                 <td>
                                    @can('view-strength-edit-delete-action')

                                     <div class="btn-group btn-group-sm">
                                         <a  data-toggle="modal" data-target="#editModal" href="{{ route('summary.edit',$row->id) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                         @method('DELETE')
                                          <a href="{{ route('summary.destroy',$row->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
</div>
<div class="col-md-4">
<form>
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="VOC Summary">
        </div>
        <div class="card-body">
            <div class="row">
                @can('view-voc-summary-button')
                <div class="col">
                  <a href="{{ route('summaryview') }}" data-toggle="modal" data-target="#exampleModal1" type="button" class="btn btn-success float-right" > Create VOC Summary</a>
                </div>
                @endcan
              </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="vocSummaryTable">
                <thead>
                    <tr>
                        <th>VOC Summary</th>
                        <th>Service</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($sumvoc as $row)
                        <tr>

                            <td>{{$row->voc_name}}</td>
                            <td>
                                @if ($row->service_name == 'Cable')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                              <td>
                                @can('view-voc-edit-delete-action')
                                  <div class="btn-group btn-group-sm">
                                    <a  data-toggle="modal" data-target="#editModal" href="{{ route('summary.edit',$row->id) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                       <a href="{{ route('summary.destroy',$row->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
</div>
<div class="col-md-4">
<form>
    <div class="card card-success ">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Gaps Summary">
        </div>
        <div class="card-body">
            <div class="row">
                @can('view-gap-summary-button')
                <div class="col">
                  <a href="{{ route('summaryview') }}" data-toggle="modal" data-target="#exampleModal2" type="button" class="btn btn-success float-right" > Create Gap Summary</a>
                </div>
                @endcan
              </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="gapSummaryTable">
                <thead>
                    <tr>
                        <th>Gap Summary</th>
                        <th>Service</th>
                        <th>Created Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($sumgap as $row)
                        <tr>
                            <td>{{$row->gap_name}}</td>
                            <td>
                                @if ($row->service_name == 'Cable')
                                <a disable class="badge badge-success" >Cable</a>
                                @else
                                <a disable class="badge badge-primary" >DTH</a>
                                @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                              <td>
                                @can('view-gap-edit-delete-action')
                                  <div class="btn-group btn-group-sm">
                                    <a  data-toggle="modal" data-target="#editModal" href="{{ route('summary.edit',$row->id) }}" class="btn btn-success"><i class="fas fa-edit" ></i></a>
                                       <a href="{{ route('summary.destroy',$row->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
</div>
</div>


            <!-- Modal 1-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"> Create Strength Summary</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('summary.store') }}" method="POST">
                        {{csrf_field()}}
                        <div >
                        <label for="name">Strength Summary</label>
                        <input type="text" name="summary_name" required class="form-control">
                        <input type="text" name="summary_title" value="summary_name" hidden>
                        </div>
                        <div class="form-group">
                            <label for="section">Select service</label>
                            <select class="form-control" required="required" id="service" name="service">
                             <option selected="selected" value="">--Select service--</option>
                             @foreach ($services as $service)
                             <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                             @endforeach
                         </select>
                        </div>

                        <div class="col-ms-3">
                          <div class="card-body">
                              <div class="row">
                                @can('view-save-strength-summary-button')

                                  <div class="col">
                        <button type="submit" class="btn btn-success float-right">Save</button>
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

                          <!-- Modal  2-->
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"> Create VOC Summary</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('summary.update') }}" method="POST">
                        {{csrf_field()}}
                        <label for="name">VOC Summary</label>
                        <input type="text" name="voc_name" required class="form-control">
                        <div class="form-group">
                            <label for="section">Select service</label>
                            <select class="form-control" required="required" id="service" name="service">
                             <option selected="selected" value="">--Select service--</option>
                             @foreach ($services as $service)
                             <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                             @endforeach
                         </select>
                        </div>
                        <input type="text" name="VOC_title" value="VOC Summary" hidden>
                        <div class="col-ms-3">
                          <div class="card-body">
                              <div class="row">
                                @can('view-save-voc-summary-button')
                                  <div class="col">
                        <button type="submit" class="btn btn-success float-right">Save</button>
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

             <!-- Modal  3-->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"> Create Gap Summary</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('summary.storeGap') }}" method="POST">
                        {{csrf_field()}}
                        <label for="name">Gap Summary</label>
                        <input type="text" name="gap_name" required class="form-control">
                        <div class="form-group">
                            <label for="section">Select service</label>
                            <select class="form-control" required id="service" name="service">
                             <option selected="selected" value="">--Select service--</option>
                             @foreach ($services as $service)
                             <option value="{{ $service['id'] }}">{{$service['service_name'] }}</option>
                             @endforeach
                         </select>
                        </div>
                        <input type="text" name="gap_title" value="Gap Summary" hidden>
                        <div class="col-ms-3">
                          <div class="card-body">
                              <div class="row">
                                @can('view-save-gap-summary-button')
                                  <div class="col">
                        <button type="submit" class="btn btn-success float-right">Save</button>
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

             <!--edit  Modal  3-->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"> edit Summary</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('summary.edit',$row->id) }}" method="POST">
                        {{csrf_field()}}
                        <label for="name">edit Summary</label>
                        <input type="text" name="{{$row->summary_name}}" class="form-control">
                        <div class="col-ms-3">
                          <div class="card-body">
                            @can('view-edit-summary-button')
                              <div class="row">
                                  <div class="col">
                        <button type="submit" class="btn btn-success float-right">Save changes</button>
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
          </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>

    questionsTable = $('#strengthSummaryTable').dataTable({

      "dom" : 'lfrtip'
    });

    questionsTable = $('#vocSummaryTable').dataTable({

    "dom" : 'lfrtip'
    });


   questionsTable = $('#gapSummaryTable').dataTable({

   "dom" : 'lfrtip'
   });


  </script>
@stop
