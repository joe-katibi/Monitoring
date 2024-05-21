@extends('adminlte::page')

@section('title', 'Agent Alert Form | Zuku Monitoring')

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
       <input type="hidden" name="category_id" value="{{ $qa_alert['category'] }}">
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
              <textarea required class="form-control" name="description" rows="2" placeholder="Enter Description ..."></textarea>
            </div>
          </div>
          <div class="col-sm">
            <div class="form-group">
              <label>Fatal Error committed:</label>
              <textarea required class="form-control" name="fatal_error" rows="2" placeholder="Enter Description ..."></textarea>
            </div>
          </div>
        </div>
          <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>Quality Analysts name</label>
                <input readonly type="text"  value="{{ $qa['name'] }}"class="form-control" placeholder="Agent name ..." >
                <input type="hidden"  type="text" name="qa_name" value="{{ $qa_alert['quality_analysts'] }}" class="form-control" placeholder="QA name ..." >
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                  <label>Signature</label>
                   <div class="input-group mb-3">
                    <img src="{{ $qualitySignatureUrl ?: 'assets/img/sign_here.JPG' }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;" id="qualitySignatureImage">
                       <span class="input-group-append">
                           <button type="button" data-toggle="modal" data-target="#signatureModal" class="btn btn-primary btn-flat"><i class="fas fa-file-signature" ></i></button>
                           <input type="hidden" id="signatureInput" name="quality_signature">
                       </span>
                   </div>
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
                <div class="input-group mb-3">
                    <img src="{{ $supervisorSignatureUrl ?: 'assets/img/sign_here.JPG' }}" alt="Supervisor Signature" style="max-width: 100px; max-height: 100px; display: block;" id="supervisorSignatureImage">
                    <span class="input-group-append">
                        <button disabled type="button" data-toggle="modal" data-target="#signatureModal-1" class="btn btn-primary btn-flat"><i class="fas fa-file-signature"></i></button>
                        <input type="hidden" id="signatureInput-1" name="supervisor_signature" >
                    </span>
                </div>

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
                   <div class="input-group mb-3">
                    <img src="{{ $agentSignatureUrl ?: 'assets/img/sign_here.JPG' }}" alt="Agent Signature" style="max-width: 100px; max-height: 100px; display: block;" id="agentSignatureImage">
                       <span class="input-group-append">
                           <button disabled type="button" data-toggle="modal" data-target="#signatureModal-2" class="btn btn-primary btn-flat"><i class="fas fa-file-signature" ></i></button>
                           <input type="hidden" id="signatureInput-2" name="agent_signature" >
                     </span>
                   </div>
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
     <!-- Signature Modal for the first signature-->
         <div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="signatureModalLabel">Quality Analysts Signature Pad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <canvas id="signatureCanvas" class="signature-pad" style="width: 100%; height: 300px; border: 1px solid black;"
        {{ isset($status) && $status->auto_status == 0 ? '' : 'disabled="disabled"' }}>
    </canvas>
</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="clearSignaturePad(1)">Clear</button>
                <button type="button" class="btn btn-primary" id="saveSignature">Save Signature</button>
                <input type="file" id="imageInput" accept="image/*">
                <button type="button" class="btn btn-primary" id="uploadImage">Upload Image</button>
            </div>
          </div>
       </div>
   </div>

    <!-- Signature Modal for the second signature-->
   <div class="modal fade" id="signatureModal-1" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="signatureModalLabel-1">Supervisor Signature Pad</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
     <div class="modal-body">
         <canvas id="signatureCanvas-1" class="signature-pad"  style="width: 100%; height: 300px; border: 1px solid black;" {{ isset($status) && $status->auto_status == 1 ? '' : 'disabled="disabled"' }}></canvas>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-warning" onclick="clearSignaturePad(2)">Clear</button>
         <button type="button" class="btn btn-primary" id="saveSignature-1">Save Signature</button>
         <input type="file" id="imageInput-1" accept="image/*">
         <button type="button" class="btn btn-primary" id="uploadImage-1">Upload Image</button>
     </div>
   </div>
</div>
</div>
    <!-- Signature Modal for the third signature-->
   <div class="modal fade" id="signatureModal-2" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="signatureModalLabel-2">Agent Signature Pad</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
     <div class="modal-body">
         <canvas id="signatureCanvas-2" class="signature-pad"  style="width: 100%; height: 300px; border: 1px solid black;" {{ isset($status) && $status->auto_status == 2 ? '' : 'disabled="disabled"' }}></canvas>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-warning" onclick="clearSignaturePad(3)">Clear</button>
         <button type="button" class="btn btn-primary" id="saveSignature-2">Save Signature</button>
         <input type="file" id="imageInput-2" accept="image/*">
         <button type="button" class="btn btn-primary" id="uploadImage-2">Upload Image</button>
     </div>
   </div>
</div>
</div>
</form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>


<script>
    // Initialize signature pads
    var signaturePad1 = new SignaturePad(document.getElementById('signatureCanvas'));
    var signaturePad2 = new SignaturePad(document.getElementById('signatureCanvas-1'));
    var signaturePad3 = new SignaturePad(document.getElementById('signatureCanvas-2'));

    // Initialize image inputs
    var imageInput = document.getElementById('imageInput');
    var imageInput1 = document.getElementById('imageInput-1');
    var imageInput2 = document.getElementById('imageInput-2');


     // Display saved Quality signature
     var qualitySignatureImage = document.getElementById('qualitySignatureImage');
     qualitySignatureImage.src = "{{ $qualitySignatureUrl ?: 'assets/img/sign_here.JPG' }}"; // Replace with actual URL or placeholder path

    // Display saved supervisor signature
    var supervisorSignatureImage = document.getElementById('supervisorSignatureImage');
    supervisorSignatureImage.src = "{{ $supervisorSignatureUrl ?: 'assets/img/sign_here.JPG' }}"; // Replace with actual URL or placeholder path

    // Display saved supervisor signature
    var agentSignatureImage = document.getElementById('agentSignatureImage');
    agentSignatureImage.src = "{{ $agentSignatureUrl ?: 'assets/img/sign_here.JPG' }}"; // Replace with actual URL or placeholder path



    function clearSignaturePad(padNumber) {
        if (padNumber === 1) {
            signaturePad1.clear();
            document.getElementById('signatureInput').value = '';
        } else if (padNumber === 2) {
            signaturePad2.clear();
            document.getElementById('signatureInput-1').value = '';
        } else if (padNumber === 3) {
            signaturePad3.clear();
            document.getElementById('signatureInput-2').value = '';
        }
    }

    // Save signature for the first canvas
    document.getElementById('saveSignature').addEventListener('click', function () {
        var signatureData = signaturePad1.toDataURL();
        document.getElementById('signatureInput').value = signatureData;
        $('#signatureModal').modal('hide');
        qualitySignatureImage.src = signatureData; // Update the displayed image with the saved signature
    });

    // Upload an image for the first canvas
    document.getElementById('uploadImage').addEventListener('click', function () {
        imageInput.click();
    });

    // Handle image input change for the first canvas
    imageInput.addEventListener('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    signaturePad1.clear();
                    signaturePad1.fromDataURL(e.target.result);
                };
            };
            reader.readAsDataURL(file);
        }
    });

    // Save signature for the second canvas
    document.getElementById('saveSignature-1').addEventListener('click', function () {
        var signatureData = signaturePad2.toDataURL();
        document.getElementById('signatureInput-1').value = signatureData;
        $('#signatureModal-1').modal('hide');
        supervisorSignatureImage.src = signatureData; // Update the displayed image with the saved signature
    });

    // Upload an image for the second canvas
    document.getElementById('uploadImage-1').addEventListener('click', function () {
        imageInput1.click();
    });

    // Handle image input change for the second canvas
    imageInput1.addEventListener('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    signaturePad2.clear();
                    signaturePad2.fromDataURL(e.target.result);
                };
            };
            reader.readAsDataURL(file);
        }
    });

    // Save signature for the third canvas
    document.getElementById('saveSignature-2').addEventListener('click', function () {
        var signatureData = signaturePad3.toDataURL();
        document.getElementById('signatureInput-2').value = signatureData;
        $('#signatureModal-2').modal('hide');
        agentSignatureImage.src = signatureData; // Update the displayed image with the saved signature
    });

    // Upload an image for the third canvas
    document.getElementById('uploadImage-2').addEventListener('click', function () {
        imageInput2.click();
    });

    // Handle image input change for the third canvas
    imageInput2.addEventListener('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    signaturePad3.clear();
                    signaturePad3.fromDataURL(e.target.result);
                };
            };
            reader.readAsDataURL(file);
        }
    });


</script>


@stop
