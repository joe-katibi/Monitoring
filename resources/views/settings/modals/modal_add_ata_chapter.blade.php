<div class="modal fade" id="modal_add_ata_chapter">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {{  Form::open(['route'=>'ata_chapters.post', 'method' => 'post']) }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create ATA Chapters</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger message" style="display:none"> </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('ata_code_lbl', 'ATA Number *',['class'=>'col-sm-12 control-label label-left'])}}
                            <div class="col-sm-12">
                                {{Form::text('ata_code', '',[ 'id' => 'ata_code', 'class'=>'form-control','placeholder'=>'ATA Number *' ])}}
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('name_lbl', 'ATA Chapter Name *',['class'=>'col-sm-12 control-label label-left'])}}
                            <div class="col-sm-12">
                                {{Form::text('name', '',[ 'id' => 'name', 'class'=>'form-control','placeholder'=>'ATA Chapter Name *' ])}}
                            </div>
                        </div>
                    </div>
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