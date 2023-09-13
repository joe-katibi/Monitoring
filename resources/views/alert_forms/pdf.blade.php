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
        border-radius: 4px;
        background-color: lightgrey;
    }

    .col {
        display: inline-block;
        width: 39%; /* Adjust as needed */
        margin-right: 5%; /* Adjust spacing between columns */
    }


</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div  class="card" id="makepdf">
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
            <h2>WANANCHI ALERT FORM</h2>
             </div>

            <div class="row">
                <div class="col col-left">
                    <div class="form-group">
                        <label class="form-label">Date:</label>
                        <input value="{{ $showalert[0]['date'] }}" type="text" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Agent Name:</label>
                        <input value="{{ $showalert[0]['agentName'] }}" type="text" class="form-input">
                    </div>
                </div>
                <div class="col col-right">
                    <div class="form-group">
                        <label class="form-label">Supervisor Name:</label>
                        <input value="{{ $showalert[0]['SupervisorName'] }}" type="text" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Quality Analysts Name:</label>
                        <input value="{{ $showalert[0]['qualityName'] }}" type="text" class="form-input">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ">
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
                <div class="col col-left">
                    <div class="form-group">
                        <label class="form-label">Quality Analysts Name:</label>
                        <input value="{{ $showalert[0]['qualityName'] }}" type="text" class="form-input">
                    </div>
                </div>
                <div class="col col-right">
                    <div class="form-group">
                        <label class="form-label">Signature:</label>
                        <img src="{{ $showalert[0]['qa_signature']  }}" style="max-width: 100px; max-height: 100px; display: block;">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Comments by the Supervisor:</label>
                        <textarea readonly class="form-control" >{{ $showalert[0]['supervisor_comment'] }}</textarea>
                    </div>
                </div>
                <div class="col col-left">
                    <div class="form-group">
                        <label class="form-label">Supervisor Name:</label>
                        <input value="{{ $showalert[0]['SupervisorName'] }}" type="text" class="form-input">
                    </div>
                </div>
                <div class="col col-right">
                    <div class="form-group">
                        <label class="form-label">Signature:</label>
                        <img src="{{ $showalert[0]['supervisor_signature']  }}" style="max-width: 100px; max-height: 100px; display: block;">
                    </div>
                </div>
                <div class="col col-left">
                    <div class="form-group">
                        <label class="form-label">Date:</label>
                        <input value="{{ $showalert[0]['date_by_supervisor']}}" type="text" class="form-input">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="text-center">
                            By signing this form, I acknowledge that I understand the feedback given and consequences thereof. I will correct this problem from today onwards.
                        </p>
                    </div>
                </div>
                <div class="col col-left">
                    <div class="form-group">
                        <label class="form-label">Agent Name:</label>
                        <input value="{{ $showalert[0]['agentName'] }}" type="text" class="form-input">
                    </div>
                </div>
                <div class="col col-right">
                    <div class="form-group">
                        <label class="form-label">Signature:</label>
                        <img src="{{ $showalert[0]['agent_signature']  }}" style="max-width: 100px; max-height: 100px; display: block;">
                    </div>
                </div>
                <div class="col col-left">
                    <div class="form-group">
                        <label class="form-label">Date:</label>
                        <input value="{{ $showalert[0]['date_by_agent'] }}" type="text" class="form-input">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</body>
</html>
