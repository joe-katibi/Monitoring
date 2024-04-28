@extends('adminlte::page')

@section('title', 'ALERT FORM')

@section('content_header')
<style>
    .container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f0f0f0;
    }

    .card {
        box-sizing: border-box;
        width: 100%;
        max-width: 1200px; /* Set a max-width for the card */
        padding: 30px;
        border: 1px solid black;
        font-style: sans-serif;
        background-color: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: auto; /* Add scrollbars if content overflows */
    }

    #button {
        background-color: #4caf50;
        border-radius: 5px;
        margin-top: auto;
        margin-left: auto;
        margin-right: auto;
        color: white;
        display: block;
        padding: 10px;
        width: fit-content;
        cursor: pointer;
    }

    h2 {
        text-align: center;
        color: #24650b;
    }

    /* Add new styles for images */
    .images-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 20px;
    }

    .image {
        width: 20%;
    }
</style>
@stop

@section('content')
<body>
    <div class="container">
        <div  class="card" id="makepdf">

            <div class="images-container">
                <img class="image" src="{{ asset('assets/img/wananchi_logo.png') }}" >
                <img class="image" src="{{ asset('assets/img/zuku-logo.png') }}" >
            </div>
            <h2>WANANCHI ALERT FORM</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Date:</label>
                        <input readonly value="{{ $showalert[0]['date'] }}"  class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Agent Name:</label>
                        <input readonly value="{{ $showalert[0]['agentName'] }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Supervisor Name:</label>
                        <input readonly value="{{ $showalert[0]['SupervisorName'] }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Quality Analysts Name:</label>
                        <input readonly value="{{ $showalert[0]['qualityName'] }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Description of the Problem:</label>
                        <textarea readonly class="form-control" >{{ $showalert[0]['description'] }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Fatal Error Committed:</label>
                        <textarea readonly class="form-control" >{{ $showalert[0]['fatal_error'] }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Quality Analysts Name:</label>
                        <input readonly value="{{ $showalert[0]['qualityName'] }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Signature:</label>
                        <img src="{{ $showalert[0]['qa_signature']  }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Comments by the Supervisor:</label>
                        <textarea readonly class="form-control" >{{ $showalert[0]['supervisor_comment'] }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Supervisor Name:</label>
                        <input readonly value="{{ $showalert[0]['SupervisorName'] }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Signature:</label>
                        <img src="{{ $showalert[0]['supervisor_signature']  }}" alt="Supervisor Signature" style="max-width: 100px; max-height: 100px; display: block;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Date:</label>
                        <input readonly value="{{ $showalert[0]['date_by_supervisor'] }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="text-center">
                            By signing this form, I acknowledge that I understand the feedback given and consequences thereof. I will correct this problem from today onwards.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Agent Name:</label>
                        <input readonly value="{{ $showalert[0]['agentName'] }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Signature:</label>
                        <img src="{{ $showalert[0]['agent_signature']  }}" alt="agent Signature" style="max-width: 100px; max-height: 100px; display: block;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Date:</label>
                        <input readonly value="{{ $showalert[0]['date_by_agent'] }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>

    </div>
    @can('view-export-PDF-alert-button')
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <a href="{{ route('autofail.generatePDF', $showalert[0]['id']) }}" class="btn btn-success">Export PDF</a>
        </div>
    </div>
    @endcan


</body>

@stop


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">



@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js">
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> --}}

@stop
