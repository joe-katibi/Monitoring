@extends('adminlte::page')

@section('title', 'CE System Links | Wananchi Group Monitoring')

@section('content_header')
    <h1 hidden>Customer Experience Systems</h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{route('link.store')  }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="card card-primary" >
          <div class="card-header">
              <h3 class="card-title" >
                CE Systems Links
            </h3>
              @can('view-create-roles')
              <div class="card-tools">
                  <div class="row">
                  <div class="col">
                  <a href="" data-toggle="modal" data-target="#exampleModal2" type="button" class="btn btn-success float-right" > View Systems</a>
              </div>
              </div>
              </div>
              @endcan
          </div>
      <div class="card-body">
        <div class="row">
        <div class="col-2">
        <div class="form-group">
          <label>Site Name</label>
          <div >
          <input type="text" class="form-control" name="site_name" placeholder="Enter site name" value="{{ old('site_name') }}" required>
          <span style="color:red">@error('site_name'){{ $message }}@enderror</span>
        </div>
        </div>
       </div>
       <div class="col-3">
        <div class="form-group">
          <label>Service</label>
          <div >
          <select class="custom-select-select2"  multiple name="service_id[]" data-placeholder="service" required>
          @foreach ($service as $row)
          <option value="{{$row['id']}}">{{$row['service_name']}}</option>
          @endforeach
          </select>
        </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Site Country</label>
            <div >
            <select class="custom-select-select2"  multiple name="country_id[]"  required>
              @foreach ($countries as $row)
                <option value="{{$row['id']}}">{{$row['country_name']}}</option>
              @endforeach
            </select>
            <span style="color:red">@error('country'){{ $message }}@enderror</span>
          </div>
        </div>
</div>
    <div class="col-3">
        <div class="form-group">
            <label>Site Url</label>
            <div >
                <input type="url" class="form-control" id="site_url" name="site_url" placeholder="Enter a site Url"  value="{{ old('site_url') }}" required>
                <div class="invalid-feedback">Please enter a valid URL.</div>
          </div>
          </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Site Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" name="site_image" id="siteImageInput" required>
                        <label class="custom-file-label" for="siteImageInput">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
          @can('view-submit-course-button')
          <div class="card-footer">
          <button type="submit" class="btn btn-success float-right">Submit</button>
      </div>
          @endcan
      </div>
    </div>
  </form>

<div class="col-12">
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3"><h3 class="card-title">CE Systems</h3></li>
                @foreach ($countries as $country)
                <li class="nav-item">
                    <a class="nav-link" id="tab-{{ $country->id }}" data-toggle="pill" href="#content-{{ $country->id }}" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">{{ $country->country_name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
                @foreach ($countries as $country)
                <div class="tab-pane fade" id="content-{{ $country->id }}" role="tabpanel" aria-labelledby="tab-{{ $country->id }}">
                    <div class="card-container">
                        @foreach ($sites as $site)
                        @if (isset($site->country_id) && $site->country_id == $country->id)
                        <a href="{{ $site->url }}" target="_blank" class="card-link">
                            <div class="card-grid">
                                <img src="{{ asset($site->image) }}" alt="Site Image">
                                <div class="container">
                                    <b>
                                        @if ($site->service == 'Cable')
                                        <span class="badge badge-success">Cable</span>
                                        @else
                                        <span class="badge badge-primary">DTH</span>
                                        @endif
                                    </b>
                                    <b>{{ $site->name }}</b>
                                    <p>Open Site</p>
                                </div>
                            </div>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal 2-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Systems</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="questionsTable">
                    <thead>
                        <tr>
                            <th>Site Name</th>
                            <th>Service</th>
                            <th>Country</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($linksEdit as $linkedit)
                        <tr>
                            <td>{{ $linkedit->name }}</td>
                            <td>{{ $linkedit->services }}</td>
                            <td>{{ $linkedit->country_names }}</td>
                            <td>{{ $linkedit->url }}</td>
                            <td>
                                @if($linkedit->status == 1)
                                <a class="badge badge-success" disabled>Active</a>
                                @else
                                <a class="badge badge-danger" disabled>Inactive</a>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @can('view-results-audit-edit')
                                    <a href="{{ route('link.edit', $linkedit->id) }}" data-toggle="modal" data-target="#exampleModal3"  class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('view-results-audit-delete')
                                    @if ($linkedit->status == 1)
                                    <a href="{{ route('link.deactivate', $linkedit->id) }}" class="btn btn-danger"><i class="fa fa-toggle-off"></i></a>
                                    @else
                                    <a href="{{ route('link.activate', $linkedit->id) }}" class="btn btn-warning"><i class="fa fa-toggle-on"></i></a>
                                    @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 3-->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Systems</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('link.update',$linkedit->id)  }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-4">
                    <div class="form-group">
                      <label>Site Name</label>
                      <div >
                      <input type="text" class="form-control" name="site_name" value="{{ $linkedit->name  }}" placeholder="Enter site name" value="{{ old('site_name') }}" required>
                      <span style="color:red">@error('site_name'){{ $message }}@enderror</span>
                    </div>
                    </div>
                   </div>
                   <div class="col-4">
                    <div class="form-group">
                      <label>Service</label>
                      <div >
                      <select class="custom-select-select2"  multiple name="service_id[]"  data-placeholder="service" required>
                        <option selected value="{{ $linkedit->services}}">{{$linkedit->services}}</option>
                      @foreach ($service as $row)
                      <option value="{{$row['id']}}">{{$row['service_name']}}</option>
                      @endforeach
                      </select>
                    </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Site Url</label>
                        <div >
                            <input type="url" class="form-control" id="site_url" name="site_url" value="{{ $linkedit->url }}" placeholder="Enter a site Url"  value="{{ old('site_url') }}" required>
                            <div class="invalid-feedback">Please enter a valid URL.</div>
                      </div>
                      </div>
                    </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Site Country</label>
                        <div >
                        <select class="custom-select-select2"  multiple name="country_id[]"  required>
                            <option selected value="{{ $linkedit->country_names }}" >{{$linkedit->country_names }}</option>
                          @foreach ($countries as $row)
                            <option value="{{$row['id']}}">{{$row['country_name']}}</option>
                          @endforeach
                        </select>
                        <span style="color:red">@error('country'){{ $message }}@enderror</span>
                      </div>
                    </div>
            </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Site Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/*" name="site_image" value="{{ $linkedit->image}}" id="siteImageInput" required>
                                    <label class="custom-file-label" for="siteImageInput">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                        @can('view-submit-course-button')
                        <button type="submit" class="btn btn-success float-right">Submit</button>
                        @endcan
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>
    span.select2.select2-container.select2-container--classic {
        width: 100% !important;
    }
    .select2-container--classic .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: white !important;
    }
    .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
        color: white !important;
    }
    .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover {
        background-color: #0056b3 !important;
        color: white !important;
    }
    .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .card-grid {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        margin: 5px;
        width: 150px;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-grid img {
        width: 100%;
        height: auto;
    }
    .card-grid:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .container {
        padding: 10px;
        text-align: center;
    }
    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white !important;
    }
</style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.custom-select-select2').select2({
            theme: "classic",
            placeholder: 'Select Country',
        });

        // Ensure DataTable is initialized only once and after the modal is fully shown
        $('#exampleModal2').on('#exampleModal2', function() {
            if (!$.fn.DataTable.isDataTable('#questionsTable')) {
                $('#questionsTable').DataTable({
                    "retrieve": true
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const siteUrlInput = document.querySelector('input[name="site_url"]');
        siteUrlInput.addEventListener('input', function () {
            if (siteUrlInput.validity.typeMismatch) {
                siteUrlInput.setCustomValidity("Please enter a valid URL.");
            } else {
                siteUrlInput.setCustomValidity("");
            }
        });

        const siteImageInput = document.querySelector('input[name="site_image"]');
        siteImageInput.addEventListener('change', function () {
            const file = siteImageInput.files[0];
            if (file) {
                const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
                if (!validImageTypes.includes(file.type)) {
                    siteImageInput.setCustomValidity("Please select a valid image file (JPEG, PNG, GIF).");
                } else {
                    siteImageInput.setCustomValidity("");
                }
            } else {
                siteImageInput.setCustomValidity("Please select an image file.");
            }
        });

        var siteImageInputElement = document.getElementById('siteImageInput');
        var siteImageLabel = siteImageInputElement.nextElementSibling;
        siteImageInputElement.addEventListener('change', function () {
            var fileName = siteImageInputElement.files[0].name;
            siteImageLabel.textContent = fileName;
        });

        const firstTab = document.querySelector('.nav-tabs .nav-item .nav-link');
        if (firstTab) {
            firstTab.classList.add('active');
            const firstContentId = firstTab.getAttribute('href');
            document.querySelector(firstContentId).classList.add('show', 'active');
        }
    });
</script>
@stop
