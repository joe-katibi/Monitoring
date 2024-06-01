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
              <input readonly class="form-control" style="color: green" name="site" value="Create site">
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
            <option >Select option</option>
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
                <option >Select option</option>
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

@stop


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    span.select2.select2-container.select2-container--classic{
        width: 100% !important;

    }
        /* Custom styles for the Select2 dropdown */
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
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
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
            width: 150px; /* Adjust the width as needed */
            height: 150px; /* Adjust the height as needed */
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.custom-select-select2').select2({
        theme: "classic",
        placeholder: 'Select Country',
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activate the first tab and content by default
        const firstTab = document.querySelector('.nav-tabs .nav-item .nav-link');
        if (firstTab) {
            firstTab.classList.add('active');
            const firstContentId = firstTab.getAttribute('href');
            document.querySelector(firstContentId).classList.add('show', 'active');
        }
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const siteUrlInput = document.querySelector('input[name="site_url"]');

            siteUrlInput.addEventListener('input', function () {
                if (siteUrlInput.validity.typeMismatch) {
                    siteUrlInput.setCustomValidity("Please enter a valid URL.");
                } else {
                    siteUrlInput.setCustomValidity("");
                }
            });
        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
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
    });
</script>

        <script>
    document.addEventListener('DOMContentLoaded', function () {
        var siteImageInput = document.getElementById('siteImageInput');
        var siteImageLabel = siteImageInput.nextElementSibling; // The label element

        siteImageInput.addEventListener('change', function (event) {
            var fileName = siteImageInput.files[0].name; // Get the selected file name
            siteImageLabel.textContent = fileName; // Set the label text to the file name
        });
    });
</script>



@stop



