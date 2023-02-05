@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')

            <div class="card card-success">
                <div class="card-header">
                   <input readonly class="form-control" style="color: green" name="category" value="Agent Alert Form">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="col-md-12 text-center">
                      <h2 name="form">Agent Alert Form</h2>
                    </div>
                    <div class="container">
                    <div class="row">
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Date</label>
                          <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Agent name</label>
                          <input type="text" class="form-control" placeholder="Agent name ..." >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Supervisor name</label>
                          <input type="text" class="form-control" placeholder="Supervisor name ..." >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>QA name</label>
                          <input type="text" class="form-control" placeholder="QA name ..." >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Description of the Problem:</label>
                          <input class="form-control" rows="2" placeholder="Enter Description ...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="form-group">
                          <label>Fatal Error committed:</label>
                          <input class="form-control" rows="2" placeholder="Enter Error committed ..." >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                          <div class="form-group">
                            <label>Comments by the supervisor:</label>
                            <input class="form-control" rows="2" placeholder="Enter Error committed ..." >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>QA name</label>
                            <input disabled  type="text" class="form-control" placeholder="Supervisor name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled  type="text" class="form-control" placeholder="Agent name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">

                            <label>Date</label>
                            <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Supervisor name</label>
                            <input disabled type="text" class="form-control" placeholder="Supervisor name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled type="text" class="form-control" placeholder="Agent name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
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
                            <input disabled type="text" class="form-control" placeholder="Supervisor name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <input disabled type="text" class="form-control" placeholder="Agent name ..." >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Export PDF</button>

                      </div>
                  </form>

                </div>
            </div>
        </div>
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
