<!DOCTYPE html>
<html>
<head>
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
        max-width: 650px; /* Set a max-width for the card */
        padding: 25px;
        border: 1px solid black;
        font-style: sans-serif;
        background-color: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: auto; /* Add scrollbars if content overflows */
    }

    .centered-h2 {
    text-align: center;
    color: #24650b;
    margin-top: 60px; /* Add margin for spacing between images and h2 */
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
        display: inline-block;
    }
    .image-left {
    float: left;
    }

    .image-right {
    float: right;
    }

.form-group {
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .form-label {
        display: block;
    }

    .form-input {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background-color: lightgrey;
    }

    .col {
        display: inline-block;
        width: 39%; /* Adjust as needed */
        margin-right: 5%; /* Adjust spacing between columns */
        margin-top: 35px;
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="card" id="makepdf">
                <!-- Separate images and position them -->
                <div class="images-container">
                    <div class="image-container">
                         <img class="image image-left" src="data:image/png;base64,{{ base64_encode(file_get_contents(asset('assets/img/wananchi_logo.png'))) }}" >
                    </div>
                       <div class="image-container">
                    <img class="image image-right" src="data:image/png;base64,{{ base64_encode(file_get_contents(asset('assets/img/zuku-logo.png'))) }}" >
                     </div>
                    </div>
            <div class="centered-h2">
            <h2>WANANCHI QUALITY COACHING FORM</h2>
           </div>
          <div class="row">
            <div class="col col-left">
                <div class="form-group">
                    <label class="form-label">Agent:</label>
                    <input value="{{$agents->name}}" type="text" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Recording ID/Mail ID/Ticket ID:</label>
                    <input value="{{$coachingShow[0]['record_id']}}" type="text" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Score Percentage:</label>
                    <input value="{{ $coachingShow[0]['scores']}}%" type="text" class="form-input">
                </div>
            </div>
            <div class="col col-right">
                <div class="form-group">
                    <label class="form-label">Supervisor Name:</label>
                    <input value="{{$supervisor->name}}" type="text" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Quality Analysts Name:</label>
                    <input value="{{ $qa->name}}" type="text" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Date of Coaching:</label>
                    <input value="{{ $coachingShow[0]['date_coaching']}}" type="text" class="form-input">
                </div>
            </div>
          </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Areas of Strengths: (Call procedures, Soft skills, Troubleshooting and Resolution, Knowledge & system)</label>
                        <textarea readonly class="form-control" >{{ $coachingShow[0]['areas_of_strength']}}</textarea>
                    </div>
               </div>
               <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Previous sessions Action points (If achieved or not)</label>
                    <textarea readonly class="form-control" >{{$coachingShow[0]['pervious_actions'] }}</textarea>
                </div>
           </div>
               <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">Current areas of Improvement:</label>
                     <textarea readonly class="form-control" >{{$coachingShow[0]['current_areas_improvement'] }}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                 <div class="form-group">
                    <label class="form-label">Action points to be taken: (Agent)</label>
                    <textarea readonly class="form-control" >{{$coachingShow[0]['action_points_taken'] }}</textarea>
                 </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-left">
                <div class="form-group">
                    <label class="form-label">Agent Signature:</label>

                    <img src="{{ $coachingShow[0]['agent_signature'] }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
                </div>
                <div class="form-group">
                    <label class="form-label">Supervisor Signature:</label>
                    <img src="{{ $coachingShow[0]['supervisor_signature'] }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
                </div>
                <div class="form-group">
                    <label class="form-label">Quality Analysts Signature:</label>
                    <img src="{{ $coachingShow[0]['quality_analyst_signature'] }}" alt="Quality Signature" style="max-width: 100px; max-height: 100px; display: block;">
                </div>
            </div>
            <div class="col col-right">
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input value="{{ $coachingShow[0]['agent_date_sign'] }}" type="text" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input value="{{ $coachingShow[0]['supervisor_date_sign']}}" type="text" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Date: </label>
                    <input value="{{ $coachingShow[0]['quality_analyst_date_sign'] }}" type="text" class="form-input">
                </div>
            </div>
          </div>


            </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</body>
</html>
