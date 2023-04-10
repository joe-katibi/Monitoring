<div class="modal fade" id="modal_add_department">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">


                {{  Form::open(['route'=>'settings.departments.post', 'method' => 'post']) }}

                <div class="modal-header edomx-card-warning">
                    <h4 class="modal-title">Create Department</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="alert alert-danger message" style="display:none"> </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('name_lbl', 'Department Name *',['class'=>'col-sm-12 control-label label-left'])}}
                                <div class="col-sm-12">
                                    {{Form::text('name', '',[ 'id' => 'name', 'class'=>'form-control timepicker' ,'placeholder'=>'Department Name *' ,  'required' => 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('description_lbl', 'Description *',['class'=>'col-sm-12 control-label label-left'])}}
                                <div class="col-sm-12">
                                    {{Form::text('description', '',[ 'description', 'class'=>'form-control timepicker' ,'placeholder'=>'Description Name *' ,  'required' => 'required' ])}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success" type="submit">Create</button>
                </div>

                {!! Form::close() !!}
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
