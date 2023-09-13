@extends('adminlte::page')

@section('title', 'Coaching Form')

@section('content_header')
    <h1 hidden >Coaching Form</h1>
@stop

@section('content')
@include('sweetalert::alert')
<form action="{{ route('coaching.store') }}" method="Post">
    @csrf
<div class="card card-success">
    <div class="card-header">
        <input readonly class="form-control" style="color: green" name="title" value="Coaching Form">
        <input type="hidden" name="id" value="{{ $coachingForm->id }}">
    </div>
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
                    <input readonly value="{{ $agents->name }}"  type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Recording ID/Mail ID/Ticket ID: </label>
                    <input readonly value="{{ $coachingForm->record_id }}" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Supervisor:</label>
                    <input readonly value="{{ $supervisor->name }}"  type="text" class="form-control">
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
                    <label class="form-label">QA Analyst:</label>
                    <input readonly value="{{ $qa->name  }}"  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Score Percentage:</label>
                    <input readonly value="{{ $coachingForm->scores}}%" type="text" class="form-control">
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
                    <label class="form-label">Agent Signature:</label>
                    <input  readonly name="agent_signature" value=""  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input readonly name="date_agent_sign" value="<?php echo date('Y-m-d H:i:s'); ?>"  class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Supervisor Signature:</label>
                    <input readonly name="supervisor_signature" value=""  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date:  </label>
                    <input readonly value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">QA Signature:</label>
                    <input readonly  name="qa_signature"  value=""  class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input readonly name="qa_signature" value="<?php echo date('Y-m-d H:i:s'); ?>"  class="form-control">
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
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
