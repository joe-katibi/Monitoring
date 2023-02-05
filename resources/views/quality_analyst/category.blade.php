@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden>Category</h1>
@stop

@section('content')
    <!-- split buttons box - Fiber Catergory-->
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
                            {{-- <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="/quality_analyst/billing/billingteamcategory">Audit this Team</a>
                      </div> --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- end split buttons box -->
    <!-- split buttons box - DTh Catergory-->
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
        // var previous = null

        $(".nav-link").click(function() {

            // alert(previous);

            // $("#"+this.id).addClass("active")
            $("#" + this.id).addClass("show active")

            // previous = "#"+this.id+"-t"
            // $(previous).removeClass("show active")

            // alert(this.id+"-t");
        });

        // $(".tab-pane").click(function(){

        //   alert(this.id);

        // $(this.id).addClass("show active")
        // });
    </script>
@stop
