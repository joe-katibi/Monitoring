@extends('adminlte::page')

@section('title', 'DTH-Live-Calls | Zuku Monitoring')

@section('content_header')
@stop

@section('content')
@include('sweetalert::alert')

  <!-- /.card -->
  <form action="{{ route('dthlivecalls.store') }}" method="POST" name="listForm">
    {{csrf_field()}}
        <div class="card card-info">
           <div class="card-header">
            <input readonly class="form-control" style="color: rgb(0, 128, 255)" value="{{ $tittle->category_name }}">
            <input hidden readonly class="form-control" style="color: rgb(0, 128, 255)" name="category" value="{{ $tittle->id }}">
            <input type="hidden" class="form-control" name="quality_analysts" value="{{ Auth::user()->id }}">
            <input type="hidden" name="reporttype" value="{{ $reporttype['type_id']}}">
        </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <label>Account number</label>
          <input type="number" name="account_number" class="form-control" placeholder="account_number" value="{{ old('account_number') }}">
          <span style="color:red">@error('account_number'){{ $message }}@enderror</span>
        </div>
             <div class="col-md-2">
                          <label>Recording ID</label>
                          <input type="number" name="recording_id" class="form-control" placeholder="record">
                          <span style="color:red">@error('recording_id'){{ $message }}@enderror</span>
                      </div>

            <div class="col-md-2">
                <label>Date</label>
                <input readonly name="date" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                <span style="color:red">@error('date'){{ $message }}@enderror</span>
            </div>
            <div class="col-2">
                <label>Category</label>
                <select class="custom-select"id="category" name="category" required data-placeholder="select" value="{{ old('category') }}">
                  <option disabled selected>Select a Category</option>
                 @foreach ($cat as $cats)
                 <option value="{{ $cats['id'] }}">{{$cats['category_name']}}</option>
                @endforeach
                </select>
                <span style="color:red">@error('category'){{ $message }}@enderror</span>
            </div>
            <div class="row">
            <div class="col-6">
                <label>Supervisor</label>
                <select class="custom-select"id="supervisor" name="supervisor" data-placeholder="select" value="{{ old('supervisor') }}" required>
                    <option  value="">--Select Supervisor--</option>

                </select>
                <span style="color:red">@error('supervisor'){{ $message }}@enderror</span>
            </div>
            <div class="col-6">
              <label>Agent</label>
              <select class="custom-select"id="agent" name="agent" data-placeholder="select" value="{{ old('agent') }}">
                <option  value="" required>--Select Agent--</option>

             </select>
             <span style="color:red">@error('agent'){{ $message }}@enderror</span>
            </div>
          </div>
        </div>
     </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-6">
                       <label for="">Issue Summary</label>
                       <select class="custom-select"id="issue_summary" name="issue_summary" data-placeholder="select" value="{{ old('issue_summary') }}">
                        <option disabled selected>Select an issue</option>
                        @foreach ($crm as $crms)
                        <option value="{{$crms['id']}}">{{$crms['call_tracker']}}</option>
                        @endforeach
                       </select>
                       <span style="color:red">@error('issue_summary'){{ $message }}@enderror</span>
                       </div>
                  <div class="col-sm-6">
                       <label for="">Strength Summary</label>
                       <select class="custom-select" id="strength_summary" multiple="true" taggable="true" name="strength_summary[]" required placeholder="select Strength" value="{{ old('strength_summary') }}"required>
                        @foreach ($sumry as $key=>$item)
                       <option value="{{$item['id']}}">{{$item['summary_name']}}</option>
                        @endforeach
                    </select>
                       <span style="color:red">@error('issue_summary'){{ $message }}@enderror</span>
                       </div>
                  </div>
          </div>
          <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                      <label for="">Issue Description:</label>
                      <textarea  name="issue_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('issue_description') }}" required ></textarea>
                      <span style="color:red">@error('issue_description'){{ $message }}@enderror</span>
                      </div>
                  <div class="col-6">
                       <label for="">Strength Description:</label>
                       <textarea  name="strength_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('strength_description') }}" required></textarea>
                       <span style="color:red">@error('strength_description'){{ $message }}@enderror</span>
                      </div>
                  </div>
              </div>
      <div class="card-body">
             <div class="row">
                      <div class="col-sm-6">
                        <label for="">Gaps Identifted Summary</label>
                        <select class="custom-select"id="gaps_summary" multiple="true" taggable="true" name="gaps_summary[]"  data-placeholder="select" value="{{ old('gaps_summary') }} " required>
                            @foreach ($sumgap as $key=>$item)
                            <option value="{{$item['id']}}">{{$item['gap_name']}}</option>>
                        @endforeach
                       </select>
                        <span style="color:red">@error('gaps_summary'){{ $message }}@enderror</span>
                       </div>
                  <div class="col-sm-6">
                          <label for="">Voice of Customer Summary</label>
                          <select class="custom-select"id="voc_summary" name="voc_summary" data-placeholder="select" value="{{ old('voc_summary') }}" required>
                            <option disabled selected> Select VOC</option>
                            @foreach ($sumvoc as $row)
                          <option value="{{$row->id}}">{{$row->summary_name}}</option>
                          @endforeach
                          </select>
                         <span style="color:red">@error('voc_summary'){{ $message }}@enderror</span>
                       </div>
                  </div>
           </div>
          <div class="card-body">
                   <div class="row">
                      <div class="col-6">
                      <label for=""> Gaps identified Description:</label>
                      <textarea  name="gaps_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('gaps_description') }}" required></textarea>
                      <span style="color:red">@error('gaps_description'){{ $message }}@enderror</span>
                    </div>
                  <div class="col-6">
                      <label for="">VOC Description:</label>
                      <textarea  name="voc_description" class="form-control float-center" rows="3" placeholder="Enter a question ..." value="{{ old('voc_description') }}" required ></textarea>
                     <span style="color:red">@error('voc_description'){{ $message }}@enderror</span>
                   </div>
                </div>
              </div>
           <div class="card-footer">
              <button type="submit" class="btn btn-success float-right">Submit</button>
               </div>
      </div>
  </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('strength_summary')  // id
</script>
<script>
    new MultiSelectTag('gaps_summary')  // id
</script>


<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Supervisor Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#supervisor").html('');
            $.ajax({
                url: '/categorylivesupervisor/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#supervisor').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#supervisor").append('<option value="' + value
                            .model_id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>



<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Agent drop down Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#category').on('change', function () {
            var qaa_call_category = this.value;
            //console.log(qaa_call_category);
            $("#agent").html('');
            $.ajax({
                url: '/categoryliveagent/'+qaa_call_category,
                type: "GET",
                data: {
                    category: qaa_call_category,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#agent').html('<option value="">-- Select --</option>');
                    console.log(result);
                    $.each(result, function (key, value) {
                        $("#agent").append('<option value="' + value
                            .model_id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>



@stop
