<div class="modal fade" id="modal_edit_department">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">


            {{  Form::open(['route'=>'settings.departments.edit', 'method' => 'post']) }}

            <div class="modal-header edomx-card-warning">
                <h4 class="modal-title">Edit Department</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="alert alert-danger message" style="display:none"> </div>
                @csrf
                <input type="hidden" name="modal_row_id" id="modal_row_id" >
                <!-- ... rest of your modal content ... -->
           <div class="col-md-12">
               <div class="form-group">
                {{Form::label('name_lbl', 'Department Name *',['class'=>'col-sm-12 control-label label-left'])}}
                <div class="col-sm-12">
                    <!-- Use the department name data attribute as the input value -->
                 {{Form::text('name', '',[ 'id' => 'modal_department_name', 'class'=>'form-control timepicker' ,'placeholder'=>'Department Name *' ,  'required' => 'required'])}}
               </div>
            </div>
           </div>
           <div class="col-md-12">
              <div class="form-group">
                {{Form::label('description_lbl', 'Description *',['class'=>'col-sm-12 control-label label-left'])}}
               <div class="col-sm-12">
                  <!-- Use the description data attribute as the input value -->
                {{Form::text('description', '',[ 'description', 'class'=>'form-control timepicker' ,'placeholder'=>'Description Name *' ,  'required' => 'required','id' => 'modal_description'])}}
              </div>
          </div>
           </div>
             <div class="col-md-12">
               {{-- <p>Row ID: <span id="modal_row_id"></span></p> --}}
           </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success" type="submit">Edit</button>
            </div>

            {!! Form::close() !!}
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

