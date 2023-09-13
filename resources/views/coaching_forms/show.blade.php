@extends('adminlte::page')

@section('title', 'Coaching Form')

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
            <h2>WANANCHI QUALITY COACHING FORM</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Agent:</label>
                        <input readonly value="{{ $agents->name }}"  class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Recording ID/Mail ID/Ticket ID: </label>
                        <input readonly value="{{ $coachingShow->record_id }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Supervisor:</label>
                        <input disabled value="{{ $supervisor->name }}"  class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Date of Coaching: </label>
                        <input disabled value="{{ $coachingShow->date_coaching }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Quality Analysts Name:</label>
                        <input disabled value="{{ $qa->name  }}"  class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Score Percentage:</label>
                        <input disabled value="{{ $coachingShow->scores}}%" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Areas of Strengths: (Call procedures, Soft skills, Troubleshooting and Resolution, Knowledge & system)</label>
                       <input readonly  class="form-control" value="{{ $coachingShow->areas_of_strength }}" rows="3" >
                    </div>
               </div>
               <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Previous sessions Action points (If achieved or not)</label>
                    <input readonly  class="form-control" value="{{ $coachingShow->pervious_actions }}" rows="3" >
                </div>
           </div>
           <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Current areas of Improvement:</label>
                <input readonly  class="form-control" value="{{ $coachingShow->current_areas_improvement }}" rows="3" >
            </div>
        </div>
       <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Action points to be taken: (Agent)</label>
            <input readonly  class="form-control" value="{{ $coachingShow->action_points_taken }}" rows="3" >
         </div>
   </div>
   <div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Agent Signature:</label>
        <img src="{{ $coachingShow->agent_signature }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Date: </label>
        <input readonly value="{{ $coachingShow->agent_date_sign }}" type="text" class="form-control">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Supervisor Signature:</label>
        <img src="{{ $coachingShow->supervisor_signature }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Date:  </label>
        <input readonly value="{{ $coachingShow->supervisor_date_sign }}" type="text" class="form-control">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Quality Analysts Signature:</label>
        <img src="{{ $coachingShow->quality_analyst_signature  }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Date: </label>
        <input readonly value="{{ $coachingShow->quality_analyst_date_sign }}" type="text" class="form-control">
    </div>
</div>
            </div>
        </div>
    </div>
    @can('view-export-PDF-coaching-button')
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <a href="{{ route('coaching.generatePDF', [$coachingShow->id, $coachingShow->results_id]) }}" class="btn btn-success">Export PDF</a>
        </div>
    </div>
    @endcan

</body>


@stop

@section('css')

@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js">
</script>
@stop
