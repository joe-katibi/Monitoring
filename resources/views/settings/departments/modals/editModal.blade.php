<div class="modal fade" id="modal_edit_follow_up">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">


                {{  Form::open(['route'=>'request.lead.complete', 'method' => 'post']) }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Customer Follow Up</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger message" style="display:none"> </div>

                    <div class="row">
                        <input type="hidden" name='requests_id' value="{{ $requests->id }}">
                        <input type="hidden" name='new_request_id' value="" id="new_request_id" >
                        <div class="col-md-12">
                            <div class="col-sm-12 form-group">
                                <label class="col-sm-12 control-label label-left">Lead Status *</label>
                                <select class="col-sm-12 form-control select2" id="status" name="status" required='required'>
                                    <option>Select an option</option>
                                    <option value="4"> Close</option>
                                    <option value="5"> Fail</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('commentLbl', 'Comment *',['class'=>'col-sm-12 control-label label-left'])}}
                                <div class="col-sm-12">
                                    {{Form::textarea('comment', '', ['id' => 'comment', 'rows' => 10,  'style' => 'resize:none','class'=>'form-control' ,'required' => 'required'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary " type="submit"> Complete</button>
                </div>

                {!! Form::close() !!}
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
