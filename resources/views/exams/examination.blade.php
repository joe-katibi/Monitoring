@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 hidden>Eximantion</h1>
@stop

@section('content')
<form action="#" method="POST" name="listForm">
    @csrf
    <div class="card card-success">
        <div class="card-header">
            <input readonly class="form-control" style="color: green" value="Examination">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                   <label>Name</label>
                   <input disabled type="text" class="form-control" placeholder="Agent" value="">
                </div>
                <div class="col-2">
                    <label>Trainer/QA</label>
                  <input disabled type="text" class="form-control" placeholder="Trainer" value="{{ $examdetails->name }}">
                </div>
         <div class="col-2">
                  <label>Department</label>
                 <input disabled type="text" class="form-control" placeholder="Department" value="{{ $examdetails->category_name }}">
              </div>
              <div class="col-2">
                <label>Exam Name</label>
               <input disabled type="text" class="form-control" placeholder="Exam Name" value="{{ $examdetails->exam_name }}">
            </div>
            <div class="col-2">
                <label>No of Questions</label>
               <input disabled type="text" class="form-control" placeholder="number of Questions" value="">
            </div>
            <div class="col-2">
                <label>Duration</label>
               <input disabled type="text" class="form-control" placeholder="Durations" value="{{ $examdetails->time }}">
            </div>
             </div>
           </div>
           <div class="card-body">
            <div class="row">
                <div class="col">
                  <a href="#" type="button" class="btn btn-success float-right" > Start Examination</a>
                </div>
              </div>
            </div>

        <div class="card-body">
        <hr>
         <div class="bix-div-container" id="">
            <table class="table table-bordered" id="tableList">
                <tbody>
                     <div class="d-flex flex-row align-items-top justify-content-start">
                       <?php
                         if( $i = 1){?>
                          @foreach ($exam as $key=>$row)
                           <tr>
                               <td>
                                 <p><b> <?php echo $i++ ;?>.)</p>
                      </div>
                      <div class="bix-td-qtxt table-responsive w-100">{!!$row->question  !!}
                         </div>
                 <div class="col">
                       <ol type="A">
                          <li >
                              <input class="with-gap" type="radio"  id="examination" name="examination_no_" value="">
                              <label>{!!$row->answer_a !!}</label>
                          </li>
                           <li>
                              <input type="radio"  id="examination" name="examination_no_" value="">
                              <label for="examination">{!!$row->answer_b !!}</label>
                          </li>
                           <li>
                              <input type="radio"  id="examination" name="examination_no_" value="">
                              <label for="examination">{!!$row->answer_c !!}</label>
                           </li>
                            <li>
                               <input type="radio"  id="examination" name="examination_no_" value="">
                               <label for="examination">{!!$row->answer_d !!}</label>
                          </li>
                      </ol>
                 </div>
                </td>
              </tr>
        @endforeach
              <tr>
                 <td style="padding: 20px;">
                 <input name="submit" type="button" value="Submit" class="btn btn-success float-right"  id="submitAnswerFrmBtn">
                 </td>
              </tr>
            <?php
        }
        else
            { ?>
                <b>No question at this moment</b>
            <?php }
         ?>
      </tbody>
      </table>
        </div>

                               {{-- <input type="radio"  id="questions" name="examination_no_[{{ $row->number }}]" value=""  > Yes </label>
                              <input type="radio" id="questions" name="examination_n_no_[{{ $row->number }}]" value=""  > No </label> --}}

          </div>
    </div>
</div>
</form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>

        questionsTable = $('#examinationTable').dataTable({

          "dom" : 'lfrtip'
        });

      </script>
@stop
