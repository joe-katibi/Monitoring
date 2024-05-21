@extends('adminlte::page')

@section('title', 'Coaching Form | Zuku Monitoring')

@section('content_header')
    <h1 hidden >Coaching Form</h1>
    <head>
    <style>
        .container {
            text-align: center;
        }
        .centered-div {
            display: inline-block; /* This ensures the div itself does not take full width */
        }
    </style>
</head>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('coaching.store',$coachingForm->id) }}" method="Post">
    @csrf
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="title" value="Coaching Form">
        <input type="hidden" name="id" value="{{ $coachingForm->id }}">
    </div>
<div class="card-body">
<div class="container">
        <div class="centered-div">
            <h3>WANANCHI QUALITY COACHING FORM</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="col">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Agent:</label>
                    <input readonly name="agent" value="{{ $agents->name }}"  type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Recording ID/Mail ID/Ticket ID: </label>
                    <input readonly name="recordingId" value="{{ $coachingForm->record_id }}" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Supervisor:</label>
                    <input readonly name="supervisor" value="{{ $supervisor->name }}"  type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date of Coaching: </label>
                    <input required readonly name="date_coaching" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Quality Analyst:</label>
                    <input readonly name="qualityAnalyst" value="{{ $qa->name  }}"  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Score Percentage:</label>
                    <input readonly name="score" value="{{ $coachingForm->scores}}%" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Areas of Strengths: (Call procedures, Soft skills, Troubleshooting and Resolution, Knowledge & system)</label>
               <textarea required class="form-control" name="areas_of_strength" rows="3" ></textarea>
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Previous sessions Action points (If achieved or not)</label>
               <textarea required class="form-control" name="previous_actions" rows="3" ></textarea>
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Current areas of Improvement:</label>
               <textarea required class="form-control" name="current_improvement" rows="3" ></textarea>
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Action points to be taken: (Agent)</label>
               <textarea required readonly class="form-control"  name="action_taken" rows="3" ></textarea>
            </div>
       </div>
    </div>

    </div>

<div class="container">

    <div class="col">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Quality Analysts Signature:</label>
                    <div class="input-group mb-3">
                        <img src="{{ $qualitySignatureUrl ?: 'assets/img/sign_here.JPG' }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;" id="qualitySignatureImage">
                           <span class="input-group-append">
                               <button type="button" data-toggle="modal" data-target="#signatureModal" class="btn btn-primary btn-flat"><i class="fas fa-file-signature" ></i></button>
                               <input type="hidden" id="signatureInput" name="quality_signature">
                           </span>
                       </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input readonly name="date_qa_sign" value="<?php echo date('Y-m-d H:i:s'); ?>"  class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Supervisor Signature:</label>
                    {{-- <input readonly name="supervisor_signature" value=""  class="form-control"> --}}
                    <img src="{{$coachingForm->supervisor_signature }}" alt="Supervisor Signature" style="max-width: 100px; max-height: 100px; display: block;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date:  </label>
                    <input readonly name="dateOfSupervisor" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Agent Signature:</label>
                    {{-- <input  readonly name="agent_signature" value=""  class="form-control"> --}}
                    <img src="{{$coachingForm->agent_signature }}" alt="Agent Signature" style="max-width: 100px; max-height: 100px; display: block;">
                   
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input readonly name="dateOfDate" value="<?php echo date('Y-m-d H:i:s'); ?>"  class="form-control">
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<div class="text-center">
    <button type="submit" class="btn-success ">Submit</button>
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
             <canvas id="signatureCanvas" class="signature-pad"  style="width: 100%; height: 300px; border: 1px solid black;" {{ $coachingForm->coaching_status == 0 ? '' : 'disabled="disabled"' }}></canvas>
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
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>



    <script>
             var signaturePad1 = new SignaturePad(document.getElementById('signatureCanvas'));

                 // Display saved supervisor signature
        var qualitySignatureImage = document.getElementById('qualitySignatureImage');
        qualitySignatureImage.src = "{{ $qualitySignatureUrl ?: 'assets/img/sign_here.JPG' }}"; // Replace with actual URL or placeholder path

            function clearSignaturePad() {

            signaturePad1.clear();
             document.getElementById('signature-3').value = '';
          }



        // Initialize the signature pad
        var canvas = document.getElementById('signatureCanvas');
        var signaturePad = new SignaturePad(canvas);

        // Save the signature
        document.getElementById('saveSignature').addEventListener('click', function () {
            var signatureData = signaturePad.toDataURL();
            document.getElementById('signatureInput').value = signatureData;
            $('#signatureModal').modal('hide');
            qualitySignatureImage.src = signatureData; // Update the displayed image with the saved signature
        });

        // Upload an image
        document.getElementById('uploadImage').addEventListener('click', function () {
            $('#imageInput').click();
        });

        // Handle image input change
        document.getElementById('imageInput').addEventListener('change', function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        canvas.getContext('2d').drawImage(image, 0, 0, canvas.width, canvas.height);
                    };
                };
                reader.readAsDataURL(file);
            }
        });
     </script>
@stop
