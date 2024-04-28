@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1 hidden>Category</h1>
@stop

@section('content')
@include('sweetalert::alert')
    <!-- split buttons box - Fiber Catergory-->
    @can('view-audit-fiber-categories')
    <div class="card">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" name="category" value="Fiber Categories">
        </div>
        <div class="card-body">
            <div class="margin">
                <div class="row">
                    @foreach ($fiber as $fbr)
                        <div class="col-md-2 margin-all-4">
                            <a href="/quality_analyst/{{ $fbr->category_id }}/billingteamcategory" type="button" class="btn btn-block btn-success">{{ $fbr->category_name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- end split buttons box -->
    <!-- split buttons box - DTh Catergory-->
    @endcan
    @can('view-audit-dth-categories')
    <div class="card">
        <div class="card-header">
            <input readonly class="form-control" style="color: rgb(0, 94, 255)" name="category" value="DTH Categories">
        </div>
        <div class="card-body">
          <div class="row">
            @foreach ($dth as $dt)
                <div class="col-md-2 margin-all-4">
                    <a href="/quality_analyst/{{ $dt->category_id }}/dthbillingteamcategory" type="button" class="btn btn-block btn-info">{{ $dt->category_name }}</a>
                </div>
            @endforeach
        </div>
        </div>
    </div>
    <!-- end split buttons box -->
  @endcan

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .margin-all-4 {
          margin: 0 0 20px 0
        }
    </style>
@stop

@section('js')
    <script>
       

        $(".nav-link").click(function() {

            $("#" + this.id).addClass("show active")
        });

    </script>
@stop
