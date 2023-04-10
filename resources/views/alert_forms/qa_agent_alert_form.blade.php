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
              <input readonly type="date" name="date_auto"  value="{{ $qa_alert['date_recorded'] }}" class="form-control"  >
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
            <div class="col-sm-3">
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

                <canvas id="signature-pad" class="signature-pad" width=200 height=60 border-color="black"></canvas>



                    {{-- <div id="signature-pad" class="signature-pad">
                        <div class="signature-pad--body">
                            <canvas></canvas>
                        </div>
                        <div class="signature-pad--footer">
                            <div class="description">Sign above</div>
                            <div class="signature-pad--actions">
                                <div>
                                    <button type="button" class="button clear" data-action="clear">Clear</button>
                                    <button type="button" class="button save" data-action="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

















                {{-- <input  type="text" name="qa_signature" class="form-control" placeholder="QA Signature ..." >

                @if (!$AlertForm->hasBeenSigned())
                   <form action="{{ $AlertForm->getSignatureRoute() }}" method="POST">
                    @csrf

                    <br/>
                    <div id="signaturePad" ></div>
                    <br/><br/>
                    <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                    <textarea id="signature" name="signed" style="display: none"></textarea>
                   </form>

                      @endif --}}

              </div>
            </div>
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
                {{-- <input disabled type="text" name="supervisor_signature"  class="form-control" placeholder="Supervisor Signature ..." > --}}

                <x-creagia-signature-pad
    border-color="#eaeaea"
    pad-classes="rounded-xl border-2"
    button-classes="bg-gray-100 px-4 py-2 rounded-xl mt-4"
    clear-name="Clear"

/>
              </div>
            </div>
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
                <input readonly name="agent_signature" type="text" class="form-control" placeholder="Agent Signature ..." >
              </div>
            </div>
            <div class="col-sm-3">
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

{{-- <script src="{{ asset('vendor/sign-pad/sign-pad.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<style>
    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{
        width: 100% !important;
        height: auto;
    }
</style> --}}

{{--
<script type="text/javascript">
    var signaturePad = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script> --}}

<script src="{{ asset('js/signature_pad.min.js') }}"></script>
<script>
    const canvas = document.querySelector('#signature-pad');
    const signaturePad = new SignaturePad(canvas);

    function resizeCanvas() {
        const ratio =  Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }

    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        const input = document.querySelector('#signature-input');
        input.value = signaturePad.toDataURL();
        this.submit();
    });
</script>

@stop
