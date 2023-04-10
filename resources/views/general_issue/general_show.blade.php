@extends('adminlte::page')

@section('title', 'General-Show')

@section('content_header')
    <h1>General Show</h1>
@stop

@section('content')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value=" Show General Issue">
    </div>
      <div class="card-body">
        <div class="row">
            <div class="container">
                <label>General Name</label>
                <div>
                    <input disabled type="text" class="form-control" value=" {{ $showgeneral->name }}">
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <table class="table table-bordered" id="questionsTable">
                        <thead>
                            <label>  SubCategory</label>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                        @if($showgeneral->id == $showgeneral->issue_general_id )
                        @foreach ($showgeneral as $key)
                        <ul>
                            <li>
                                {{ $showgeneral->sub_name }}
                            </li>
                        </ul>

                        @endforeach
                        @endif
                    </td>
                    </tr>
                    </tbody>
                    </table>

                </div>

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
