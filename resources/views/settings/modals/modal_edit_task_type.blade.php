<div class="modal fade" id="modal_edit_task_type">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                {{  Form::open(['route'=>'task_types.update', 'method' => 'post']) }}
    
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Task Type</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger message" style="display:none"> </div>
    
                    <div class="row">
                        
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('name_lbl', 'Task Type *',['class'=>'col-sm-12 control-label label-left'])}}
                                <div class="col-sm-12">
                                    {{Form::text('name', '',[ 'id' => 'name', 'class'=>'form-control','placeholder'=>'Task Type *' ])}}
                                </div>
                            </div>
                        </div>
                        
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('description', 'Description',['class'=>'col-sm-12 control-label label-left'])}}
                                <div class="col-sm-12">
    
                                    {{Form::textarea('description', '', ['id' => 'description', 'rows' => 4,  'style' => 'resize:none','class'=>'form-control'])}}
                                </div>
                            </div>
                        </div> --}}
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary " type="submit">Update</button>
                </div>
    
                {!! Form::close() !!}
    
    
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>