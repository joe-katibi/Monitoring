@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')  
  <!-- /.card -->

  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Escalation Results</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-2">
            <label>Supervisor</label>
          <input disabled type="text" class="form-control" placeholder="supervisor">
        </div>
        <div class="col-2">
            <label>Agent name</label>
          <input disabled type="text" class="form-control" placeholder="agent name">
        </div>
        <div class="col-2">
            <label>QA name</label>
          <input disabled type="text" class="form-control" placeholder="qc name">
        </div>
        <div class="col-2">
            <label>Date</label>  
          <input disabled value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
        </div>
        <div class="col-2">
            <label>Customer Account</label>
          <input disabled type="text" class="form-control" placeholder="Account">
        </div>
        <div class="col-2">
            <label>Recording ID</label>
          <input disabled type="text" class="form-control" placeholder="record">
        </div>
        <div class="col-2">
          <label>Archived</label>
        <input disabled type="text" class="form-control" placeholder="archived">
      </div>
      </div>

      <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Question</th>
            <th>Archived</th>
            <th>Percentage</th>
          </tr>
        </thead>
        <tbody> 
          <tr>
            
            <tr>
                <td>number</td>
                <td>question</td>
                <td>archived</td>
                <td>percentage</td>
                    
          </tr>
           
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.card-body -->

                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="card-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Feedback From QC</label>
                            <textarea disabled class="form-control float-center" rows="3" placeholder="Enter ..."></textarea>
                          </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                  <!--  <button type="submit" class="btn btn-success float-right">Save & Finish</button> -->
                  <a href="#" class="btn btn-success float-left"  > Edit Call</a>
                    <a href="/quality_analyst/Welcometeamcategory" class="btn btn-success float-right"  > QA Another Call</a>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->
  </div>
  <!-- /.card -->




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop