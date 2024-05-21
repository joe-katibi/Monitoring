@extends('adminlte::page')

@section('title', 'Permissions | Zuku Monitoring')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')
<section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <input readonly class="form-control" style="color: green" name="category" value="Permissions">
                                </div>

                                    {{-- <div class="card-tools" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                                        <a href="{{ route('permission.create') }}" type="button" class="btn btn-success float-right" > Create Permissions  </a>
                                    </div> --}}

                                <div class="card-body ">
                                    <table class="table table-bordered" id="questionsTable">
                                        <thead>
                                            <tr>
                                                <th class="text-capitalize">Permissions</th>
                                                <th class="text-capitalize">Created</th>
                                                <th class="text-capitalize text-right" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($permissions as $permission)
                                            <tr>
                                                <td>{{$permission['description']}}</td>
                                                <td>{{$permission['created_at']}}</td>
                                                <td class="text-right" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                                                <div class="btn-group btn-group-sm">
                                      <a href="{{ route('permission.update',$permission['id']) }}" class="btn btn-success" ><i class="fas fa-edit" ></i></a>
                                     <a href="{{ route('permission.destroy',$permission['id']) }}" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                                       </div>
                                              </td>
                                            </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
 <!-- /.modal-content -->

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
