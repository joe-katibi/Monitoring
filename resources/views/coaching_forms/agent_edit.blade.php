@extends('adminlte::page')

@section('title', 'Coaching Form | Zuku Monitoring')

@section('content_header')
    <h1 hidden >Coaching Form Edit</h1>
@stop

@section('content')
@include('sweetalert::alert')
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" value="Coaching Form">
    </div>
    <form action="{{ route('coaching.update',$coachingShow[0]['id'] ) }}" method="Post">
        @csrf

<div class="card-body">
    <div center class="container">
    <h3 >WANANCHI QUALITY COACHING FORM</h3>
    </div>
    <div class="card-body">
        <div class="col">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Agent:</label>
                    <input readonly value="{{$agents->name}}"  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Recording ID/Mail ID/Ticket ID: </label>
                    <input readonly value="{{ $coachingShow[0]['record_id'] }}" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Supervisor:</label>
                    <input disabled value="{{ $supervisor->name}}"  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date of Coaching:</label>
                    <input disabled value="{{ $coachingShow[0]['date_coaching']}}" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Quality Analyst:</label>
                    <input disabled value="{{ $qa->name }}"  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Score Percentage:</label>
                    <input disabled value="{{ $coachingShow[0]['scores']}}%" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Areas of Strengths: (Call procedures, Soft skills, Troubleshooting and Resolution, Knowledge & system)</label>
               <input readonly  class="form-control" value="{{ $coachingShow[0]['areas_of_strength'] }}" rows="3" >
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Previous sessions Action points (If achieved or not)</label>
                <input readonly  class="form-control" value="{{ $coachingShow[0]['pervious_actions'] }}" rows="3" >
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Current areas of Improvement:</label>
                <input readonly  class="form-control" value="{{ $coachingShow[0]['current_areas_improvement'] }}" rows="3" >
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label  class="form-label">Action points to be taken: (Agent)</label>
                <input required class="form-control" name="agent_action" rows="3" >
            </div>
       </div>
    </div>

    </div>

<div class="container">

    <div class="col">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Agent Signature:</label>
                    <div class="input-group mb-3">
                        <img src="{{ $agentSignatureUrl ?: 'assets/img/sign_here.JPG' }}" alt="Agent Signature" style="max-width: 100px; max-height: 100px; display: block;" id="agentSignatureImage">
                        <span class="input-group-append">
                        <button type="button" data-toggle="modal" data-target="#signatureModal" class="btn btn-primary btn-flat"><i class="fas fa-file-signature" ></i></button>
                     <input type="hidden" id="signatureInput" name="agent_signature" >
                     </span>
                      </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input readonly value="<?php echo date("Y-m-d H:i:s");?>" name="agent_date_sign" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Supervisor Signature:</label>
                    <img src="{{ $coachingShow[0]['supervisor_signature']  }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date:  </label>
                    <input readonly value="{{ $coachingShow[0]['supervisor_date_sign'] }}" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Quality Analysts Signature:</label>
                    <img src="{{ $coachingShow[0]['quality_analyst_signature']  }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input readonly value="{{ $coachingShow[0]['quality_analyst_date_sign'] }}" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

</div>
<div class="card-footer">
    <button type="submit" class="btn btn-success float-right">Update and Save</button>

  </div>
                <!-- Signature Modal -->
                <div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                         <div class="modal-header">
                         <h5 class="modal-title" id="signatureModalLabel">Signature Pad</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <canvas id="signatureCanvas" class="signature-pad"  style="width: 100%; height: 300px; border: 1px solid black;"></canvas>
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
    var agentSignatureImage = document.getElementById('agentSignatureImage');
    agentSignatureImage.src = "{{ $agentSignatureUrl ?: 'assets/img/sign_here.JPG' }}"; // Replace with actual URL or placeholder path

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
            agentSignatureImage.src = signatureData; // Update the displayed image with the saved signature
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
