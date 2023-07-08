@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1></h1>
@stop

@section('content')
@include('sweetalert::alert')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green"  value="Best agents of the month">
    </div>
    <div class="container-fluid ">
        <div class="row">
            @foreach($agents as $country => $services)
            <div class="col-lg-5 mb-8">
                <div class="card card-outline border-primary" >
                    <h3 class="text-center">{{ $country }}</h3>
                    <div class="row">
                        @foreach($services as $service => $agentsData)
                        <div class="col-md-6">
                            <div class="card card-primary card-outline" >
                                @foreach($agentsData as $agent)
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="/assets/img/user1-128x128.jpg"
                                             alt="User profile picture">
                                             {{-- <img src="{{ $agent['profile_image'] }}" alt="{{ $agent['agent_name'] }}"> --}}
                                  </div>
                                  <div class="profile-username text-center">
                                    <h4>{{ $agent['agent_name'] }}</h4>
                                    <hr>
                                    <p>{{ $agent['department_name'] }}</p>
                                    <hr>
                                    <p>{{ $agent['country_name'] }} </p>
                                    <hr>
                                    <p>
                                        @if ($agent['service_name'] == 'Cable')
                                        <a disable class="badge badge-success" >Cable</a>
                                         @else
                                       <a disable class="badge badge-primary">DTH</a>
                                         @endif
                                    </p>
                                    <hr>
                                    <div class="small-audio-player text-center" style="width: 60px; ">
                                        <audio controls>
                                            <source src="/assets/{{ $agent['call_file'] }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>






    </div>
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title" >
                Brief of the Week
            </h3>
            @can('view-create-roles')
            <div class="card-tools">
                <div class="row">
                <a href="{{ route('summaryview') }}" data-toggle="modal" data-target="#exampleModal1" type="button" class="btn btn-success float-right" > New Brief</a>
                <div class="col">
                <a href="{{ route('summaryview') }}" data-toggle="modal" data-target="#exampleModal2" type="button" class="btn btn-info float-right" > View Briefs</a>
            </div>
            </div>
            </div>
            @endcan
        </div>

      <div class="card-body">
       <table class="table table-bordered" id="questionsTable">
        <thead>
        <tr>
            {{-- <th>NO</th> --}}
            <th>Topic</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($briefView as $briefViews)
        <tr>
        {{-- <td>{{ $briefViews['id'] }}</td> --}}
        <td>{{ $briefViews['brief_topic'] }}</td>
        <td>{{ $briefViews['brief_description']}}</td>
    </tr>
        @endforeach
    </tbody>
       </table>
    </div>
</div>

<div class="card card-info">
    <div class="card-header">
        <input readonly class="form-control" style="color: blue"  value="Weekly Summary">
    </div>
    <div class="card-body">

            <table class="table table-bordered table-scroll" id="questionsTable" >
                <thead>
                    <tr>
                        <th style="width: 10px" >Countries</th>
                        @foreach ($weekHeaders as $week)
                            <th style="width: 10px">{{ $week }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($averages as $country => $data)
                        <tr>
                            <td>{{ $country }}</td>
                            @foreach ($data['weeks'] as $week => $percentage)
                                <td>{{ $percentage }}%</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </div>
</div>
<div class="card card">
    <div class="card-header">
        <input readonly class="form-control" style="color: blue"  value="Monthly Summary">
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="questionsTable">
            <thead>
                <tr>
                    <th >Countries</th>
                    @foreach ($monthHeaders as $month)
                        <th>{{ $month }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($averages as $country => $data)
                    <tr>
                        <td>{{ $country }}</td>
                        @foreach ($data['months'] as $month => $percentage)
                            <td>{{ $percentage }}%</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

      </div>
    </div>
  </div>


                          <!-- Modal  1-->
                          <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"> Create New Brief of Week</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="{{ route('home.store') }}" method="POST">
                                    {{csrf_field()}}
                                    <label for="name">Brief Topic</label>
                                    <input required type="text" name="brief_topic" class="form-control">
                                    <label for="name">Brief Description</label>
                                    <input required type="text" name="brief_description" class="form-control" style="height: 100px;">

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


                          <!-- Modal  2-->
                          <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"> Briefs of Week</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered" id="questionsTable">
                                        <thead>
                                            <tr>
                                                <th >Brief Topic</th>
                                                <th>Brief Description</th>
                                                <th>Date Created</th>
                                                <th>Created by</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach ($briefs as $brief )
                                                <tr>
                                                    <td>{{ $brief['brief_topic'] }}</td>
                                                    <td>{{ $brief['brief_description']}}</td>
                                                    <td>{{ $brief['created_at'] }}</td>
                                                    <td>{{ $brief['name'] }}</td>
                                                    <td>
                                                        @if($brief['status'] == 1)
                                                              <a disable class="badge badge-success" >Active</a>
                                                         @else
                                                      <a disable class="badge badge-danger" >Inactive</a>
                                                         @endif
                                                    </td>
                                                    <td>  <div class="btn-group btn-group-sm">
                                                        @can('view-results-audit-edit')

                                                        <a  href="{{ route('home.edit',$brief['id']) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                         @can('view-results-audit-delete')
                                                         <a href="{{ route('home.destroy',$brief['id']) }}" class="btn btn-info"><i class="fa fa-trash-alt"></i></a>
                                                         @endcan

                                                         @can('view-results-audit-delete')
                                                         @if ($brief['status'] == 1)
                                                         <a href="{{ route('home.deactivate',$brief['id']) }}" class="btn btn-danger"><i class="fa fa-toggle-off"></i></a>
                                                         @else
                                                         <a href="{{ route('home.activate',$brief['id']) }}" class="btn btn-warning"><i class="fa fa-toggle-on"></i></a>
                                                         @endif

                                                         @endcan
                                                           </div></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                              </div>
                            </div>
                             </div>



@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/profile-box.css') }}">

    <style>
        .table-wrapper {
            overflow-x: auto;
            max-width: 100%;
        }

        .table-scroll {
            min-width: 600px; /* Adjust this value based on your requirements */
        }

        .fixed-column {
            position: sticky;
            left: 0;
            z-index: 1;
            background-color: #fff;
        }
    </style>
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function () {
    $("#create_role").click(function (e) {
            $("#role_id").val("-1");
            $("#role_name").val("");
            $("#role_description").val("");
            // $("#scheme_active").prop('checked', true);
            $("#role_form_modal").modal('show');
        });

});
</script>

<script>

    questionsTable = $('#questionsTable').dataTable({

      "dom" : 'lfrtip'
    });




  </script>


@stop
