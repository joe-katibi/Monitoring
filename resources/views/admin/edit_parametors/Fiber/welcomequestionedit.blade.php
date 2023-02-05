@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')

<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="QuestionS & Parameters">
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
              {{-- <a href="/admin/edit_parametors/Fiber/welcomequestion" type="button" class="btn btn-success float-right" > Create Parameters</a> --}}
              <a href="{{ route('create_parametor') }}" type="button" class="btn btn-success float-right" > Create Parameters</a>
            </div>
          </div>
    </div>
    <div class="card-body">
      <table class="table table-bordered" id="questionsTable">
        <thead>
            <tr>
                <th>Number</th>
                <th>Question</th>
                <th>Parameter</th>
                <th>service</th>
                <th>Category</th>
                <th>Marks Passed</th>
                <th>Marks Failed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $key=>$item )
                <tr>
                <td>{{$item->number}}</td>
                <td>{{$item->question}}</td>
                <td>{{$item->summarized}}</td>
                <td>{{$item->service_name}}</td>
                <td>{{$item->category_name}}</td>
                <td>{{$item->yes}}</td>
                <td>{{$item->no}}</td>
                <td class="text-right" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                <div class="btn-group btn-group-sm">
                      {{-- <a href="edit/{{ $item->id }}" class="btn btn-success"><i class="fas fa-edit"></i></a> --}}
                      <a href="{{ route('parametor.edit',$item->id ) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                     <a href="destroy/{{ $item->id }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                       </div>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
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
