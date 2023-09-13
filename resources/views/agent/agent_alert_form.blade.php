@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 hidden></h1>
@stop

@section('content')
@include('sweetalert::alert')

    <div class="card card-success">
        <div class="card-header">
                    <input readonly class="form-control" style="color: green" name="category" value="Alert Form">
        </div>
                 <form action="{{ route('agent_alert_form.update',$showalert[0]['id'] ) }}" method="Post">
                    @csrf
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="col-md-12 text-center">
                      <h2 name="form">Alert Form</h2>
                    </div>
                    <div class="container">
                    <div class="row">
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Date</label>
                          <input readonly value="{{ $showalert[0]['date'] }}" class="form-control"  >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Agent name</label>
                          <input readonly type="text" value="{{ $showalert[0]['agentName'] }}" class="form-control"  >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Supervisor name</label>
                          <input readonly type="text" value="{{ $showalert[0]['SupervisorName'] }}" class="form-control" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Quality Analysts name</label>
                          <input readonly type="text" value="{{ $showalert[0]['qualityName'] }}" class="form-control"  >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Description of the Problem:</label>
                          <input readonly value="{{ $showalert[0]['description'] }}" class="form-control" rows="2" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="form-group">
                          <label>Fatal Error committed:</label>
                          <input  readonly value="{{ $showalert[0]['fatal_error'] }}"  class="form-control" rows="2"  >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                          <div class="form-group">
                            <label>Comments by the supervisor:</label>
                            <input class="form-control" rows="2" readonly value="{{ $showalert[0]['supervisor_comment'] }}"  >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Quality Anaylsts name</label>
                            <input readonly type="text" value="{{ $showalert[0]['qualityName'] }}"  type="text" class="form-control"  >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <div class="input-group mb-3">
                             <img src="{{ $showalert[0]['qa_signature']  }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
                           </div>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input readonly value="{{ $showalert[0]['date_by_qa'] }}"  class="form-control"  >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Supervisor name</label>
                            <input readonly type="text" value="{{ $showalert[0]['SupervisorName'] }}" class="form-control" >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <div class="input-group mb-3">
                                <img src="{{ $showalert[0]['supervisor_signature'] }}" alt="Supervisor Signature" style="max-width: 100px; max-height: 100px; display: block;" >
                               </div>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input readonly value="{{ $showalert[0]['date_by_supervisor'] }}" class="form-control"  >
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
                            <input readonly type="text" value="{{ $showalert[0]['agentName'] }}" class="form-control"  >
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Signature</label>
                            <div class="input-group mb-3">
                                <img src="{{ $agentSignatureUrl ?: 'assets/img/sign_here.JPG' }}" alt="Agent Signature" style="max-width: 100px; max-height: 100px; display: block;" id="agentSignatureImage">
                                <span class="input-group-append">
                                <button type="button" data-toggle="modal" data-target="#signatureModal" class="btn btn-primary btn-flat"><i class="fas fa-file-signature" ></i></button>
                             <input type="hidden" id="signatureInput" name="agent_signature" >
                             </span>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label>
                            <input readonly name="date_agent" type="text" value="<?php echo date("d-m-Y H:i:s");?>" class="form-control" >
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Update and Save</button>

                      </div>


                </div>
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
                <button type="button" class="btn btn-warning" onclick="clearSignaturePad(3)">Clear</button>
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
