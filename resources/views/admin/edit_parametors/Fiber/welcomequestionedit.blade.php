@extends('adminlte::page')

@section('title', 'Parameter')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')
@include('sweetalert::alert')

<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="QuestionS & Parameters">
    </div>
    <div class="card-body">
        @can('view-create-parametor')
        <div class="row">
            <div class="col">
              <a href="{{ route('create_parametor') }}" type="button" class="btn btn-success float-right" > Create Parameters</a>
            </div>
          </div>
          @endcan
    </div>
    <div class="card-body">
        <div class="container">
      <table class="table table-bordered" id="questionsTable">
        <thead>
            <tr>
                <th>Category</th>
                <th style="width: 20%">service</th>
                <th style="width: 20%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $key=>$item )
                <tr>
                <td>{{$item->category_name}}</td>
                <td>
                    @if ($item->service_id == '1')
                    <a disable class="badge badge-success" >Cable</a>
                    @else
                    <a disable class="badge badge-primary">DTH</a>
                    @endif
                </td>
                <td class="text-right" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                <div class="btn-group btn-group-sm">
                      <a href="{{ route('parametor.show',$item->id ) }}" class="btn btn-warning" ><i class="fas fa-eye"></i>View Parameters</a>
                       </div>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
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
