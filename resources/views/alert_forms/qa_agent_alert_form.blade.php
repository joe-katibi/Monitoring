@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('autofail.store') }}" method="Post">
    @csrf
<div class="card card-success">
    <div class="card-header">
       <input readonly class="form-control" style="color: green" name="title" value="Agent Alert Form">
       <input type="hidden" name="results_id" value="{{ $qa_alert['id'] }}">
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <div class="col-md-12 text-center">
          <h2 name="form">Agent Alert Form</h2>
        </div>
        <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
              <label>Date</label>
              <input readonly type="text" name="date_auto"  value="{{ $qa_alert->date_recorded }}" class="form-control"  >
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Agent name</label>
              <input readonly type="text"  value="{{ $agents['name'] }}"class="form-control" placeholder="Agent name ..." >
              <input type="hidden"  name="agent_name"  type="text"  value="{{ $qa_alert['agent_name'] }}"class="form-control" placeholder="Agent name ..." >
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Supervisor name</label>
              <input readonly type="text"  value="{{ $supervisor['name'] }}"class="form-control" placeholder="Agent name ..." >
              <input type="hidden"  type="text" name="supervisor_name"  value="{{ $qa_alert['supervisor'] }}" class="form-control" placeholder="Supervisor name ..." >
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>QA name</label>
              <input readonly type="text"  value="{{ $qa['name'] }}"class="form-control" placeholder="Agent name ..." >
              <input type="hidden"  type="text" name="qa_name" value="{{ $qa_alert['quality_analysts'] }}" class="form-control" placeholder="QA name ..." >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <!-- textarea -->
            <div class="form-group">
              <label>Description of the Problem:</label>
              <textarea class="form-control" name="description" rows="2" placeholder="Enter Description ..."></textarea>
            </div>
          </div>
          <div class="col-sm">
            <div class="form-group">
              <label>Fatal Error committed:</label>
              <textarea class="form-control" name="fatal_error" rows="2" placeholder="Enter Description ..."></textarea>
            </div>
          </div>
        </div>
          <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>QA name</label>
                <input readonly type="text"  value="{{ $qa['name'] }}"class="form-control" placeholder="Agent name ..." >
                <input type="hidden"  type="text" name="qa_name" value="{{ $qa_alert['quality_analysts'] }}" class="form-control" placeholder="QA name ..." >
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Signature</label>
                        <canvas id="signature-pad-1" class="signature-pad" width="200" height="50" style="border: 1px solid black;"  {{ $status->auto_status == 0 ? '' : 'disabled="disabled"' }}></canvas>
                        <input type="hidden" id="signature-1" name="signature1"  >
                        <button type="button" onclick="clearSignaturePad(1)">Clear</button>
                    </div>
              </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Date</label>
                <input readonly  name="date_by_qa" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control"  >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm">
              <div class="form-group">
                <label>Comments by the supervisor:</label>
                <input class="form-control" name="supervisor_comment" rows="2" placeholder="supervisor committed ..." >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>Supervisor name</label>
                    <input readonly type="text"  value="{{ $supervisor['name'] }}"class="form-control" placeholder="Agent name ..." >
              <input type="hidden"  type="text" name="supervisor_name"  value="{{ $qa_alert['supervisor'] }}" class="form-control" placeholder="Supervisor name ..." >
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Signature</label>
                    <canvas id="signature-pad-2" class="signature-pad" width="200" height="50" style="border: 1px solid black;" {{ $status->auto_status == 1 ? '' : 'disabled="disabled"' }}></canvas>
                    <input type="hidden" id="signature-2" name="signature2" >
                    <button type="button" onclick="clearSignaturePad(2)">Clear</button>
                    </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Date</label>
                <input readonly  name="date_by_supervisor" value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
              </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="form-group">
                <p>By signing this form, I acknowledge that I understand the feedback given and consequences thereof. I will correct this problem from today henceforth.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>Agent name</label>
                <input readonly type="text"  value="{{ $agents['name'] }}"class="form-control" placeholder="Agent name ..." >
                <input type="hidden"  name="agent_name"  type="text"  value="{{ $qa_alert['agent_name'] }}"class="form-control" placeholder="Agent name ..." >
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Signature</label>
                    <canvas id="signature-pad-3" class="signature-pad" width="200" height="50" style="border: 1px solid black;"  {{ $status->auto_status == 2 ? '' : 'disabled="disabled"' }}></canvas>
                    <input type="hidden" id="signature-3" name="signature3" >
                    <button type="button" onclick="clearSignaturePad(3)">Clear</button>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Date</label>
                <input readonly  name="date_by_agent" value="<?php echo date("d-m-Y H:i:s");?>" class="form-control"  >
              </div>
            </div>
          </div>
        </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success float-right">Submit</button>

          </div>


    </div>
</div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    {{-- <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css"> --}}
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>


<script>
    var signaturePad1 = new SignaturePad(document.getElementById('signature-pad-1'));
    var signaturePad2 = new SignaturePad(document.getElementById('signature-pad-2'));
    var signaturePad3 = new SignaturePad(document.getElementById('signature-pad-3'));

    function clearSignaturePad(padNumber) {
        if (padNumber === 1) {
            signaturePad1.clear();
            document.getElementById('signature-1').value = '';
        } else if (padNumber === 2) {
            signaturePad2.clear();
            document.getElementById('signature-2').value = '';
        } else if (padNumber === 3) {
            signaturePad3.clear();
            document.getElementById('signature-3').value = '';
        }
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        var signature1 = signaturePad1.toDataURL();
        var signature2 = signaturePad2.toDataURL();
        var signature3 = signaturePad3.toDataURL();

        document.getElementById('signature-1').value = signature1;
        document.getElementById('signature-2').value = signature2;
        document.getElementById('signature-3').value = signature3;
    });
</script>


@stop
