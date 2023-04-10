<div class="modal fade" id="modal_add_assembly">
    <div class="modal-dialog modal-md" >
        <div class="modal-content">
            {{  Form::open(['route'=>'assembly.post', 'method' => 'post']) }}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Assembly</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger message" style="display:none"> </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('name_lbl', 'Assembly Name *',['class'=>'col-sm-12 control-label label-left'])}}
                            <div class="col-sm-12">
                                {{Form::text('name', '',[ 'id' => 'name', 'class'=>'form-control','placeholder'=>'Assembly Name *' ])}}
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
                <button class="btn btn-primary " type="submit">Create</button>
            </div>

            {!! Form::close() !!}
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>