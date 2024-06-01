<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.E Dashboard | Wananchi Group Monitoring</title>
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
            background-color: white;
            color: #007bff !important;
            border-color: #007bff #007bff #fff;
        }

        .nav-tabs .nav-link {
            color: white; /* Default color for unselected state */
        }

        .nav-tabs .nav-link:hover {
            color: #007bff; /* Color on hover for unselected state */
        }

        .card-primary {
            border-color: #007bff;
        }

        .card-tabs .card-header {
            background-color: #007bff;
            color: white;
        }

        .justify-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .bg-gray-100 {
            background-color: #f7fafc;
        }

        .dark .bg-gray-900 {
            background-color: #1a202c;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .text-gray-700 {
            color: #4a5568;
        }

        .dark .text-gray-500 {
            color: #a0aec0;
        }

        .underline {
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }

        .fixed {
            position: fixed;
        }

        .top-0 {
            top: 0;
        }

        .right-0 {
            right: 0;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .sm\:block {
            display: block;
        }

        .top-left-logo {
            display: flex;
            align-items: center;
            margin-right: auto;
        }

        .top-left-logo img {
            height: 50px; /* Adjust the height as needed */
        }
    </style>
</head>
<body>
    <div class="py-5">
        <div class="top-left-logo px-6 py-4">
            <img src="assets/img/logo_wananchi.png" alt="Logo">
        </div>
        <div class="d-flex justify-content-center px-4">
            <label class="btn btn-block btn-primary"><h3>Customer Experience Systems Dashboard</h3></label>
        </div>

        @if (Route::has('login'))
            <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" type="button" class="btn btn-block btn-success">Zuku Monitoring</a>
                @else
                    <a href="{{ route('login') }}" type="button" class="btn btn-block btn-primary">Log in to Zuku Monitoring</a>
                @endauth
            </div>
        @endif
    </div>

    <div class="col-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3"><h3 class="card-title">Systems</h3></li>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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

</body>
</html>
