@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>

@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Patient</div>

                <div class="panel-body">
                  <div class="col-sm-2 bg-info text-right">First Name</div>
                  <div class="col-sm-10">{{ $patient->first_name }}</div>

                  <div class="col-sm-2 bg-info text-right">Last Name</div>
                  <div class="col-sm-10">{{ $patient->last_name }}</div>

                  <div class="col-sm-2 bg-info text-right">Gender</div>
                  <div class="col-sm-10">{{ $patient->gender }}</div>

                  <div class="col-sm-2 bg-info text-right">Email</div>
                  <div class="col-sm-10">{{ $patient->email }}</div>

                  <div class="col-sm-2 bg-info text-right">Contact Number</div>
                  <div class="col-sm-10">{{ $patient->contact_number }}</div>


                  <div class="form-group col-md-12">
                    <div class="row">
                      <h4>Details</h4>
                      @for ($i = 0; $i < 3; $i++)
                        <div class="col-sm-6 bg-info text-white"><small>Scheduled on: Sept 20, 2019</small></div>
                        <div class="col-sm-6 bg-info text-white text-right"><small>Edit | Archive</small></div>
                        <div class="col-sm-12 bg-warning" style="padding-left:20px;padding-bottom:10px;margin-bottom:8px;border-bottom:1px solid #eee;">
                          dfadfagdgggfgfsgfgfgnb <br>
                          dfdgdgaeefaefaegregrsghrghsthtrhrtshsrthrsth
                        </div>
                       
                      @endfor
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    {{ Form::label('record', 'Add new details') }}
                    {{ Form::textarea('record', null, ['class' => 'form-control', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                  </div>
                  
                  <div class="form-group col-md-offset-4 col-md-4">
                    {{ Form::checkbox('checkbox_visit', 'Yes') }}
                    {{ Form::label('sched', 'Schedule') }}
                    {{ Form::text('schedule', null, array('id' => 'schedule', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy', 'disabled')) }}
                  </div>

                  <div class="form-group col-md-4">
                    {{ Form::checkbox('checkbox_fee', 'Yes') }}
                    {{ Form::label('fee', 'Service Fee') }}
                    {{ Form::text('amount', null, array('id' => 'amount', 'class' => 'form-control', 'disabled')) }}
                  </div>
      
                  <div class="col-md-offset-9 col-md-3">
                    <a class="btn btn-primary form-control" href="{{ url('patient/create') }}">Save</a>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#schedule").datepicker();

  $("input[name='checkbox_visit']").click(function(){
      $("#schedule").prop("disabled", !$(this).is(":checked"));
      $("#schedule").val('');
  });

  $("input[name='checkbox_fee']").click(function(){
      $("#fee").prop("disabled", !$(this).is(":checked"));
      $("#fee").val('');
  });
});
</script>
@endsection
