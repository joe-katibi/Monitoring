@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>DTH report</h1>
@stop

@section('content') 
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
       
        <!-- /Page Header -->
        
        <!-- Search Filter -->
        <div class="row ">
            <div class="col-sm-6 col-md-3"> 
                <div class="form-group form-focus">
                    <label class="focus-label">Country</label>
                    <div class="cal-icon">
                        <select class="custom-select" placeholder="" id="country" name="country" value="{{ old('country') }}">
                            <span style="color:red">@error('category'){{ $message }}@enderror</span>
                           
                            <option>Kenya</option>

                          </select>
                        
                    </div>
                </div>
               </div>
                <div class="col-sm-6 col-md-3">  
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <label class="focus-label">From</label>
                        <input class="form-control floating datetimepicker" type="text">
                    </div>
                </div>
               </div>
                <div class="col-sm-6 col-md-3">  
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <label class="focus-label">To</label>
                        <input class="form-control floating datetimepicker" type="text">
                    </div>
                </div>
               </div>
                <div class="col-sm-6 col-md-3"> 
                <div class="form-group form-focus">
                    <div class="cal-icon">
                    <label class="focus-label">To</label>
                    <button type="button" class="btn btn-success">Search</button>
                </div> 
                </div> 
               </div>     
              </div>
        <!-- /Search Filter -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Services</th>
                                <th>Category</th>
                                <th>Agent</th>
                                <th>Quality Analysts</th>
                                <th>Supervsior</th>
                                <th>Customer Code</th>
                                <th>Recording ID</th>
                                <th>date</th>
                                <th>Auto Fail</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kenya</td>
                                <td>Fiber</td>
                                <td>Inbound</td>
                                <td>Joe Doe</td>
                                <td>Doe Joe</td>
                                <td>JOn Joe</td>
                                <td>00001</td>
                                <td>00002</td>
                                <td>9/8/22</td>
                                <td>0</td>
                                <td> 98% </td>
                            </tr>
                            <tr>
                                <td>Kenya</td>
                                <td>Fiber</td>
                                <td>Outbound</td>
                                <td>Mr Joe</td>
                                <td>Mr Joe</td>
                                <td>Mr Joe</td>
                                <td>00011</td>
                                <td>00012</td>
                                <td>10/8/2022</td>
                                <td>1</td>
                                <td>5%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop