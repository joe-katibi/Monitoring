@extends('adminlte::page')

@section('title', 'Create-Parameter | Zuku Monitoring')

@section('content_header')
    <h1 hidden> </h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('parametor.store') }}" method="post">
    {{-- <form action="welcomequestionedit" method="post"> --}}
    @csrf
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Create Question & Parameters">
    </div>
  <div class="container-fluid p-4">
    <div class="row jusify-content-md-center">
      <div class="col-md-9">
                    <div class="card-body">
                    <label for="">Question</label>
                    <input type="number" class="form-control" name="number" placeholder="Question 1" value="{{ old('number') }}">
                    <span style="color:red">@error('number'){{ $message }}@enderror</span>
                    </div>
                <div class="card-body">

                    <label for="">Description:</label>
                    <textarea  name="question" class="form-control float-center" rows="3" placeholder="Enter a question ..."></textarea>
                    <span style="color:red">@error('question'){{ $message }}@enderror</span>
                </div>
                <div class="card-body">

                    <label for="">Summarized parameter</label>
                    <textarea  name="summarized" class="form-control float-center" rows="2" placeholder="summarized parameter ..."></textarea>
                    <span style="color:red">@error('summarized'){{ $message }}@enderror</span>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                          <!-- select -->
                          <div class="form-group">
                            <label>Select Marks(Yes)</label>
                            <input type="number" class="form-control" name="yes" placeholder="marks" value="{{ old('yes') }}">
                            <span style="color:red">@error('yes'){{ $message }}@enderror</span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Select Marks(NO)</label>
                            <select class="custom-select" placeholder="" id="no" name="no" value="{{ old('no') }}">
                              <span style="color:red">@error('no'){{ $message }}@enderror</span>
                              <option disabled selected>select a mark</option>
                               <option value="0">0</option>
                              <option value="Auto Fail">Auto Fail</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Services</label>
                            <select class="custom-select" placeholder="" id="service" name="service" value="{{ old('service') }}">
                              <span style="color:red">@error('service'){{ $message }}@enderror</span>
                              <option disabled selected>select a Service</option>
                              @foreach($Category as $row )
                              <option value="{{ $row['id'] }}">{{$row['service_name']}}</option>

                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Category</label>
                            <select class="custom-select" placeholder="" id="category" name="category" value="{{ old('category') }}">
                            <option  value="">--Select Category--</option>
                            </select>
                          </div>
                        </div>
                      </div>
              </div>
            </div>
            </div>
            <div class="card-body">
                @can('view-btn-create-parameters')
                <div class="row">
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-success float-right">Create Parameters</button>
                </div>
                </div>
                @endcan
            </div>

        </div>
    </div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Service Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#service').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#category").html('');
            $.ajax({
                url: '/auto-fail/'+qaa_call_category,
                type: "GET",
                data: {
                    service: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#category').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#category").append('<option value="' + value
                            .id + '">' + value.category_name + '</option>');
                    });

                }
            });
        });

    });
</script>

<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Supervisor Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#supervisor").html('');
            $.ajax({
                url: '/categorylivesupervisor/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#supervisor').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#supervisor").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>

@stop
