@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')

   <div class="card card-warning">
        <div class="card-header">
                  <h3 class="card-title">Agent Alert Form</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <form action="" method="post">

                    @csrf

                    @foreach ($alertfrom as $item)

                    <div class="col-md-12 text-center">

                      <input hidden value="{{$item['title']}}"><a>{{$item['title']}}</a>

                    </div>
                    @endforeach
                    <div class="row">
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Date</label>
                          <input disabled value="{{$item['date']}}" class="form-control"  >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Agent name</label>
                          <input disabled type="text" class="form-control" value="{{$item['agent_name']}}" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Supervisor name</label>
                          <input disabled type="text" class="form-control" Value="{{$item['supervisor_name']}}" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>QA name</label>
                          <input disabled type="text" class="form-control" Value="{{$item['qa_name']}}">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Description of the Problem:</label>
                          <input disabled class="form-control" rows="2" Value="{{$item['description']}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="form-group">
                          <label>Fatal Error committed:</label>
                          <input disabled class="form-control" rows="2" Value="{{$item['fatal_error']}}" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                          <div class="form-group">
                            <label>Comments by the supervisor:</label>
                            <input disabled class="form-control" rows="2" Value="{{$item['supervisor_comment']}}" >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>QA name</label>
                            <input disabled  type="text" class="form-control" placeholder="Supervisor name ..."Value="{{$item['qa_name']}}"  >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled  type="text" class="form-control" placeholder="Agent name ..." Value="{{$item['qa_signature']}}" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">

                            <label>Date</label>
                            <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"Value="{{$item['date_by_qa']}}"  >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Supervisor name</label>
                            <input disabled type="text" class="form-control" placeholder="Supervisor name ..."  Value="{{$item['supervisor_name']}}" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled type="text" class="form-control" placeholder="Agent name ..." Value="{{$item['supervisor_signature']}}" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input disabled  class="form-control"  Value="{{$item['date_by_supervisor']}}"  >
                          </div>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="form-group">
                            <p>By signing this form, I acknowledge that I understand the feedback given and consequences thereof. I will correct this problem from today henceforth.</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Agent name</label>
                            <input  type="text" class="form-control" placeholder="agent name" name="agent_name" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input  type="text" class="form-control" placeholder="Agent signature" name="agent_signature"  >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control" name="date_by_agent"  >
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Submit</button>

                      </div>
                  </form>

                </div>
            </div>
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
    <script> console.log('Hi!'); </script>
@stop

